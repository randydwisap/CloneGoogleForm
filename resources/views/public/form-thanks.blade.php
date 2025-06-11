<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #f8fafc; /* slate-50 */
        }
    </style>
</head>
<body class="text-slate-700">

    <div class="container mx-auto max-w-2xl px-4 flex items-center justify-center min-h-screen">

        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 p-8 md:p-12 text-center w-full">

            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-teal-100 mb-6">
                <svg class="h-12 w-12 text-teal-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h1 class="text-3xl md:text-4xl font-bold tracking-tight text-slate-900">Tanggapan Terkirim!</h1>
            <p class="mt-3 text-base text-slate-600">
                Terima kasih. Tanggapan Anda untuk formulir <strong class="font-semibold text-slate-800">"{{ $formTitle }}"</strong> telah berhasil kami rekam.
            </p>

            <div class="mt-10">
                <a href="{{ url()->previous() }}" class="inline-flex items-center justify-center px-6 py-3 rounded-lg text-base font-bold text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transform hover:-translate-y-0.5 transition-all duration-200 shadow-lg shadow-sky-600/20">
                    Kirim tanggapan lain
                </a>
            </div>
            
        </div>
    </div>
</body>
</html>