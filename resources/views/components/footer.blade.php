<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<!-- Footer -->
    <footer class="left-0 fixed bottom-0 w-full h-[50px] bg-slate-800 flex items-center justify-center gap-[26px] px-4 text-white text-[11px]">
        <div class="container mx-auto flex justify-between gap-2">
            <div>
                <h3 class="font-semibold text-gray-800 mb-3">About</h3>
                <p>AI Medical System empowers health decisions with smart detection and remedy suggestions.</p>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800 mb-3">Quick Links</h3>
                <ul class="flex items-center justify-between gap-1 space-y-2">
                    <li><a href="{{ url('/') }}" class="hover:text-blue-600">Home</a></li>
                    <li><a href="{{ url('/detect') }}" class="hover:text-blue-600">Detect</a></li>
                    <li><a href="#" class="hover:text-blue-600">About</a></li>
                    <li><a href="#" class="hover:text-blue-600">Contact</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-semibold text-gray-800 mb-3">Contact</h3>
                <p>Email: support@aimedical.com</p>
                <p>Phone: +94 77 123 4567</p>
            </div>
        </div>
        <div class="bg-gray-200 text-center py-4 text-xs text-gray-500">
            © {{ date('Y') }} AI Medical System. All rights reserved.
        </div>
    </footer>

</html>



    