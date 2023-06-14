<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Webappfix</title>
</head>

<body>
    <h1>{{ $mailData['title'] }}</h1>

    <p>{{ $mailData['body'] }}</p>
    <table class="table table-striped table-hover table-bordered" id="tableStudent" width="100%"
        style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="padding: 8px; border: 1px solid #ddd; background-color: #f2f2f2; text-align: left;">
                    {{ __('Mã sinh viên') }}</th>
                <th style="padding: 8px; border: 1px solid #ddd; background-color: #f2f2f2; text-align: left;">
                    {{ __('Name') }}</th>
                <th style="padding: 8px; border: 1px solid #ddd; background-color: #f2f2f2; text-align: left;">
                    {{ __('Email') }}</th>
                <th style="padding: 8px; border: 1px solid #ddd; background-color: #f2f2f2; text-align: left;">
                    {{ __('Khoa') }}</th>
                <th style="padding: 8px; border: 1px solid #ddd; background-color: #f2f2f2; text-align: left;">
                    {{ __('Điểm kết thúc môn') }}</th>
                <th style="padding: 8px; border: 1px solid #ddd; background-color: #f2f2f2; text-align: left;">
                    {{ __('Kết quả') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mailData['students'] as $item)
                <tr>
                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $item->id_student }}</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $item->name }}</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $item->email }}</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $item->department }}</td>
                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $item->scores }}</td>
                    @if ($item->scores >=5)
                        <td style="padding: 8px; border: 1px solid #ddd;">Qua Môn</td>
                    @else
                        <td style="padding: 8px; border: 1px solid #ddd;">Nợ Môn</td>
                    @endif
                    
                </tr>
            @endforeach
        </tbody>
    </table>


</body>

</html>
