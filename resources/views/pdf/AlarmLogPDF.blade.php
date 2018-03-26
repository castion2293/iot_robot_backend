<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            padding: 8px 0px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        td {
            font-size: 0.8em;
        }
        td:nth-child(3){
            padding-right: 1em;
        }
    </style>
</head>
<body>
<table>
    <tr>
        <th>異常名稱</th>
        <th>異常代碼</th>
        <th>日期</th>
        <th>時間</th>
    </tr>
    @foreach ($alarms as $alarm)
        <tr>
            <td>{{ $alarm->ALARM_NAME }}</td>
            <td>{{ $alarm->ALARM_CODE }}</td>
            <td>{{ $alarm->ALARM_DATE }}</td>
            <td>{{ $alarm->ALARM_TIME }}</td>
        </tr>
    @endforeach
</table>
</body>
</html>