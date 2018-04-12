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
        <th>日期</th>
        <th>良品</th>
        <th>不量品</th>
    </tr>
    @foreach ($throughputs as $throughput)
        <tr>
            <td>{{ $throughput['date'] }}</td>
            <td>{{ ($throughput['OK_Throughput']->first()) ?? 0 }}</td>
            <td>{{ $throughput['NG_Throughput']->first() ?? 0 }}</td>
        </tr>
    @endforeach
</table>
<h3>良品總和: {{ $total_ok }}</h3>
<h3>不良品總和: {{ $total_ng }}</h3>
<h3>良率: {{ $rate }}%</h3>
</body>
</html>