<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $form->title }}</title>
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

    <div class="container mx-auto max-w-3xl px-4 py-16 md:py-24">

        <div class="bg-white rounded-2xl shadow-xl border border-slate-200 p-8 md:p-12">

            <header class="mb-10 text-center">
                <h1 class="text-4xl md:text-5xl font-bold tracking-tight text-slate-900">{{ $form->title }}</h1>
                @if($form->description)
                    <p class="mt-4 text-lg text-slate-600 max-w-2xl mx-auto">{{ $form->description }}</p>
                @endif
            </header>

            @if (session('success'))
                <div class="bg-teal-50 border-l-4 border-teal-500 text-teal-900 p-4 rounded-r-lg mb-8" role="alert">
                    <p class="font-bold">Tanggapan Terkirim!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <form action="{{ route('public.form.store', $form) }}" method="POST">
                @csrf
                <div class="space-y-10">

                    @foreach($form->questions as $question)
                        <div class="pt-6 border-t border-slate-200">
                            <label for="question-{{$question->id}}" class="block text-base font-semibold text-slate-800">
                                {{ $question->text }}
                                @if($question->is_required) <span title="Wajib diisi" class="text-red-500 font-normal">*</span> @endif
                            </label>
                            
                            <div class="mt-3">
                                @switch($question->type)
                                    @case('text')
                                        <input id="question-{{$question->id}}" type="text" name="question[{{ $question->id }}]" class="block w-full rounded-lg border-slate-300 bg-slate-50 shadow-sm py-3 px-4 focus:border-sky-500 focus:ring-2 focus:ring-sky-500/50 transition-all duration-200" {{ $question->is_required ? 'required' : '' }}>
                                        @break
                                    @case('textarea')
                                        <textarea id="question-{{$question->id}}" name="question[{{ $question->id }}]" rows="4" class="block w-full rounded-lg border-slate-300 bg-slate-50 shadow-sm py-3 px-4 focus:border-sky-500 focus:ring-2 focus:ring-sky-500/50 transition-all duration-200" {{ $question->is_required ? 'required' : '' }}></textarea>
                                        @break
                                    @case('select')
                                        <select id="question-{{$question->id}}" name="question[{{ $question->id }}]" class="block w-full rounded-lg border-slate-300 bg-slate-50 shadow-sm py-3 px-4 focus:border-sky-500 focus:ring-2 focus:ring-sky-500/50 transition-all duration-200" {{ $question->is_required ? 'required' : '' }}>
                                            <option value="">-- Pilih salah satu --</option>
                                            @foreach($question->options as $option)
                                                <option value="{{ $option->value }}">{{ $option->value }}</option>
                                            @endforeach
                                        </select>
                                        @break
                                    @case('radio')
                                        <div class="space-y-3">
                                            @foreach($question->options as $option)
                                                <div class="flex items-center">
                                                    <input type="radio" id="option_{{ $option->id }}" name="question[{{ $question->id }}]" value="{{ $option->value }}" class="h-5 w-5 text-sky-600 border-slate-400 focus:ring-sky-500" {{ $question->is_required ? 'required' : '' }}>
                                                    <label for="option_{{ $option->id }}" class="ml-3 text-base text-slate-700">{{ $option->value }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @break
                                    @case('checkbox')
                                        <div class="space-y-3">
                                            @foreach($question->options as $option)
                                                <div class="flex items-center">
                                                    <input type="checkbox" id="option_{{ $option->id }}" name="question[{{ $question->id }}][]" value="{{ $option->value }}" class="h-5 w-5 rounded text-sky-600 border-slate-400 focus:ring-sky-500">
                                                    <label for="option_{{ $option->id }}" class="ml-3 text-base text-slate-700">{{ $option->value }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @break
                                @endswitch
                            </div>

                            @error('question.' . $question->id)
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    @endforeach
                </div>

                <div class="flex items-center justify-end mt-12 pt-8 border-t border-slate-200">
                    <a href="#" onclick="document.querySelector('form').reset(); return false;" class="text-sm font-medium text-slate-600 hover:text-slate-900 mr-6">
                        Bersihkan
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center px-8 py-3 rounded-lg text-base font-bold text-white bg-sky-600 hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500 transform hover:-translate-y-0.5 transition-all duration-200 shadow-lg shadow-sky-600/20">
                        Kirim
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <footer class="text-center mt-12">
            <p class="text-sm text-slate-500">Dibuat pada {{ $form->created_at->format('d F Y') }}</p>
        </footer>
    </div>
</body>
</html>