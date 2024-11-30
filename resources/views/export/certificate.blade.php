<html>
    <head>
        <title>{{ $exam->title }} - {{ $grade->user->name }}</title>
        <style>
            * {
                margin:0;
                padding:0;
                width:100%;
                /* height:100%; */
    
            }

            body {
                width:100%;
            }

            {!! $exam->template->template_css !!}
        </style>
    </head>

    <title>{{ $grade->user->name }}</title>

    @php
    $templateHtml = $exam->template->template_html;
        $replacements = [
            '{name}' => ucwords(strtolower($grade->user->name)),
            '{exam_date}' => $grade->updated_at->format('d/m/Y'),
            '{gender}' => $grade->user->student && $grade->user->student->gender ? ($grade->user->student->gender == "M" ? "Male" : "Female") : '-',
            '{date_of_birth}' => $grade->user->student && $grade->user->student->date_of_birth ? $grade->user->student->date_of_birth->format('d/m/Y') : '-',
            '{student_number}' => $grade->user->created_at->format('Ymd').$grade->user->id,
            '{total_score}' => $grade->grade,
            '{valid_until}' => $grade->exam->valid_until ? $grade->updated_at->addYears($grade->exam->valid_until)->format('d/m/Y') : '-',
            
            '{province}' => $grade->user->student && $grade->user->student && $grade->user->student->province ? $grade->user->student->province->name : '-',
            '{city}' => $grade->user->student && $grade->user->student && $grade->user->student->city ? $grade->user->student->city->name : '-',
            '{district}' => $grade->user->student && $grade->user->student && $grade->user->student->district ? $grade->user->student->district->name : '-',
            '{village}' => $grade->user->student && $grade->user->student && $grade->user->student->village ? $grade->user->student->village->name : '-',

        ];

        if($grade->grade_details) {
            foreach($grade->grade_details as $gradeDetail) {
                $replacements[$gradeDetail['variable']] = $gradeDetail['grade'];
            }
        }

        $replacedContent = str_replace(array_keys($replacements), array_values($replacements), $templateHtml);
    @endphp
    {!! $replacedContent !!}
</html>