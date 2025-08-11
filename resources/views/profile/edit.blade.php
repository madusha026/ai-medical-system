<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>AI Medical System - Profile</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100">

  <!-- Navbar -->
  <nav class="bg-blue-800 text-white shadow-md fixed top-0 left-0 w-full z-50">
    <div class="container max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
      <div class="text-2xl font-bold">AI Medical System</div>
      <ul class="flex gap-6 items-center text-md font-medium">
        <li><a href="{{ route('home') }}" class="hover:text-blue-400 transition">Home</a></li>
        <li><a href="{{ route('detect') }}" class="hover:text-blue-400 transition">Detect</a></li>
        <li><a href="{{ route('about') }}" class="hover:text-blue-400 transition">About</a></li>
        <li><a href="{{ route('contact') }}" class="hover:text-blue-400 transition">Contact</a></li>

        @auth
          <li><a href="{{ route('profile.edit') }}" class="hover:text-blue-400 transition">Profile</a></li>
          <li>
            <form method="POST" action="{{ route('logout') }}" class="inline">
              @csrf
              <button type="submit" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded text-white text-sm transition">
                Logout
              </button>
            </form>
          </li>
        @endauth

        @guest
          <li><a href="{{ route('login') }}" class="hover:text-blue-400 transition">Login</a></li>
        @endguest
      </ul>
    </div>
  </nav>

  <!-- Padding for fixed navbar -->
  <div class="pt-20"></div>

  <!-- Header -->
  <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
      <h2 class="text-xl font-semibold text-gray-800 leading-tight">
        {{ __('Profile') }}
      </h2>
    </div>
  </header>

  <!-- Main Content -->
  <main class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

      <section class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl mx-auto">
          @include('profile.partials.update-profile-information-form')
        </div>
      </section>

      <section class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl mx-auto">
          @include('profile.partials.update-password-form')
        </div>
      </section>

      <section class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl mx-auto">
          @include('profile.partials.delete-user-form')
        </div>
      </section>

        <!-- Medicine Reminder Section -->
        <section class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl mx-auto">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Medicine Reminder</h2>
            <form id="medicine-reminder-form" class="space-y-4">
            <div>
                <label for="medicine-name" class="block font-medium text-gray-700">Medicine Name</label>
                <input type="text" id="medicine-name" name="medicine_name" class="mt-1 block w-full border rounded px-3 py-2" placeholder="Enter medicine name" required />
            </div>

            <div>
                <label for="reminder-time-label" class="block font-medium text-gray-700">Reminder Time of Day</label>
                <select id="reminder-time-label" name="reminder_time_label" class="mt-1 block w-full border rounded px-3 py-2" required>
                <option value="" disabled selected>Select time of day</option>
                <option value="morning">Morning</option>
                <option value="afternoon">Afternoon</option>
                <option value="night">Night</option>
                </select>
            </div>

            <div>
                <label for="reminder-exact-time" class="block font-medium text-gray-700">Exact Time</label>
                <input type="time" id="reminder-exact-time" name="reminder_exact_time" class="mt-1 block w-full border rounded px-3 py-2" required />
                <p class="text-sm text-gray-500 mt-1">Select exact time for notification</p>
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Add Reminder
            </button>

            <button type="button" id="clear-reminders" class="ml-4 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Clear All Reminders
            </button>
            </form>

            <p id="reminder-message" class="mt-4 text-green-600 hidden"></p>

            <!-- List of current reminders -->
            <div id="reminders-list" class="mt-6">
            <h3 class="font-semibold text-gray-900 mb-2">Current Reminders:</h3>
            <ul class="list-disc list-inside text-gray-700" id="reminder-items"></ul>
            </div>
        </div>
        </section>

    </div>
  </main>

<script>
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  // Request notification permission on page load
  document.addEventListener('DOMContentLoaded', () => {
    console.log('Notification permission status:', Notification.permission); // <-- Log initial status

    if (Notification.permission !== 'granted' && Notification.permission !== 'denied') {
      Notification.requestPermission().then(permission => {
        console.log('Notification permission after request:', permission);

        // Show test notification if granted
        if (permission === 'granted') {
          new Notification('Test Notification', {
            body: 'Notifications are enabled and working!',
          });
        }
      });
    } else if (Notification.permission === 'granted') {
      // Show test notification immediately if already granted
      new Notification('Test Notification', {
        body: 'Notifications are enabled and working!',
      });
    }

    loadAndScheduleReminders();
  });

  // Helper to calculate milliseconds until next reminder time
  function msUntilReminder(selectedTime) {
    if (!selectedTime) return 0;
    const now = new Date();
    const [hour, minute] = selectedTime.split(':').map(Number);

    let reminderDate = new Date(now.getFullYear(), now.getMonth(), now.getDate(), hour, minute, 0, 0);

    console.log('Current time:', now.toLocaleTimeString()); // <-- Added debug log
    console.log('Reminder time:', reminderDate.toLocaleTimeString()); // <-- Added debug log

    if (reminderDate <= now) {
      reminderDate.setDate(reminderDate.getDate() + 1);
    }

    return reminderDate - now;
  }

  // Schedule a notification for a reminder
  function scheduleNotification(reminder) {
    const msDelay = msUntilReminder(reminder.exact_time || reminder.exactTime);

    console.log(`Scheduling notification for ${reminder.medicine_name || reminder.medicineName} in ${msDelay / 1000} seconds`);

    setTimeout(() => {
      console.log('Time to notify:', new Date().toLocaleTimeString()); // <-- DEBUG LOG HERE
      if (Notification.permission === 'granted') {
        new Notification('Medicine Reminder', {
          body: `It's time to take your medicine: ${reminder.medicine_name || reminder.medicineName} (${reminder.time_label || reminder.timeLabel}) at ${reminder.exact_time || reminder.exactTime}`,
        });
      } else {
        console.log('Notification permission denied or not granted');
      }
      // Reschedule next notification in 24 hours
      scheduleNotification(reminder);
    }, msDelay);
  }

  // Fetch reminders from backend (normal web route)
  async function fetchReminders() {
    try {
      const res = await fetch('/medicine-reminders', {
        headers: { 'Accept': 'application/json' },
        credentials: 'same-origin',
      });
      if (res.ok) {
        return await res.json();
      }
      return [];
    } catch (error) {
      console.error('Failed to fetch reminders', error);
      return [];
    }
  }

  // Add new reminder via normal web route
  async function addReminder(reminder) {
    try {
      const res = await fetch('/medicine-reminders', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': csrfToken, 
        },
        credentials: 'same-origin',
        body: JSON.stringify(reminder),
      });
      if (!res.ok) {
        alert('Failed to save reminder on server.');
      }
    } catch (error) {
      console.error('Failed to add reminder', error);
      alert('Failed to save reminder on server.');
    }
  }

  // Clear all reminders via normal web route
  async function clearReminders() {
    try {
      const res = await fetch('/medicine-reminders', {
        method: 'DELETE',
        headers: { 
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken, 
         },
        credentials: 'same-origin',
      });
      if (res.ok) {
        renderReminders([]);
      }
    } catch (error) {
      console.error('Failed to clear reminders', error);
      alert('Failed to clear reminders on server.');
    }
  }

  // Load reminders from server and schedule them
  async function loadAndScheduleReminders() {
    const reminders = await fetchReminders();
    reminders.forEach(scheduleNotification);
    renderReminders(reminders);
  }

  // Render reminders list in UI
  function renderReminders(reminders) {
    const list = document.getElementById('reminder-items');
    list.innerHTML = '';

    if (reminders.length === 0) {
      list.innerHTML = '<li>No reminders set.</li>';
      return;
    }

    reminders.forEach(r => {
      const li = document.createElement('li');
      li.textContent = `${r.medicine_name} - ${r.time_label} at ${r.exact_time}`;
      list.appendChild(li);
    });
  }

  // Handle form submission
  document.getElementById('medicine-reminder-form').addEventListener('submit', async function (e) {
    e.preventDefault();

    const medicineName = document.getElementById('medicine-name').value.trim();
    const timeLabel = document.getElementById('reminder-time-label').value;
    const exactTime = document.getElementById('reminder-exact-time').value;

    if (!medicineName || !timeLabel || !exactTime) {
      alert('Please fill in all fields.');
      return;
    }

    const reminder = { medicine_name: medicineName, time_label: timeLabel, exact_time: exactTime };

    // Show confirmation message
    const msg = document.getElementById('reminder-message');
    msg.textContent = `Reminder for "${medicineName}" set for ${timeLabel} at ${exactTime}. Notification will trigger at that exact time. Keep this tab open!`;
    msg.classList.remove('hidden');

    await addReminder(reminder);
    scheduleNotification(reminder);
    loadAndScheduleReminders();

    this.reset();
  });

  // Clear reminders button
  document.getElementById('clear-reminders').addEventListener('click', async () => {
    await clearReminders();
    location.reload();
  });
</script>


</body>
</html>
