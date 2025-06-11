<?php

namespace App\Http\Controllers;
use App\Models\Form;
use Illuminate\Http\Request;

class PublicFormController extends Controller
{
     public function show(Form $form)
    {
        $form->load('questions.options'); // Eager loading
        return view('public.form-show', compact('form'));
    }

    public function store(Request $request, Form $form)
    {
        $validationRules = [];
        foreach ($form->questions as $question) {
            if ($question->is_required) {
                $validationRules['question.' . $question->id] = 'required';
            }
            // Jika checkbox, harus array
            if ($question->type === 'checkbox' && $question->is_required) {
                $validationRules['question.' . $question->id] = 'required|array';
            }
        }
        $validated = $request->validate(['question' => 'required|array'] + $validationRules);

        $submission = $form->submissions()->create();

        foreach ($validated['question'] as $questionId => $value) {
            $submission->answers()->create([
                'question_id' => $questionId,
                'value' => is_array($value) ? json_encode($value) : $value,
            ]);
        }

        return redirect()->route('public.form.thanks', $form);
    }

    public function thanks(Form $form)
    {
        return view('public.form-thanks', ['formTitle' => $form->title]);
    }
}
