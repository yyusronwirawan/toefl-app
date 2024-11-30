<html>
    <head>
        <title>{{ $exam->title }}</title>
        <style>
            table {
                border-collapse: collapse;
                font-size:12px;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }

            table th {
                padding:8px; 
                text-align: left;
            }

            table td {
                padding:4px; 
                /* text-align: center; */
            }

            .title {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;"
            }

            @media print {
                .new-page {
                    page-break-before: always;
                }
            }
                        
        </style>
    </head>
    <body>
        @if($setting)
            <br>
            <img src="{{ $setting->app_url }}/storage/upload_files/settings/{{ $setting->logo }}" alt="" width="150px" style="position: absolute; margin-top:-50px;">
            <br>
            <br>
        @endif
        <center>
            <div class="title">
                <h3>REKAPITULASI {{ strtoupper($exam->title) }}</h3>
            </div>
        </center>

        <table width="100%" border="1" style="font-size:8;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>Provinsi</th>
                    <th>Kota/Kab</th>
                    <th>Detail Skor</th>
                    <th align="center">Total Skor</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grades as $index => $grade)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $grade->user->name }}</td>
                        <td>{{ $grade->user->student && $grade->user->student->gender ? ($grade->user->student->gender == "M" ? 'Laki-laki' : "Perempuan") : "-" }}</td>
                        <td>{{ $grade->user->student && $grade->user->student && $grade->user->student->province ? $grade->user->student->province->name : '-' }}</td>
                        <td>{{ $grade->user->student && $grade->user->student && $grade->user->student->city ? $grade->user->student->city->name : '-' }}</td>
                        <td>
                            @if($grade->grade_details)
                                @foreach($grade->grade_details as $gradeDetail)
                                    {{ $gradeDetail['grade_category_name'] }} : {{ $gradeDetail['grade'] }} <br>
                                @endforeach
                            @else
                                -
                            @endif
                        </td>
                        <td align="center"><b>{{ $grade->grade }}</b></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>