<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ban co XO</title>
</head>
<body>

<table>
    @for ($i = 1; $i <= $n; $i++)
    <tr>
        @for ($j = 1; $j <= $n; $j++)
        <td align="center">
            @if ($j % 2 == 0)
                X
            @else
                O
            @endif
        </td>
        @endfor
    </tr>
    @endfor
</table>

</body>
</html>
    