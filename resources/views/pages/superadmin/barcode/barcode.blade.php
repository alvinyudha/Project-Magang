<!DOCTYPE html>
<html>

<head>
    <title>Barcodes</title>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.6/dist/JsBarcode.all.min.js"></script>

    <style>
        .text-center {
            /* padding: 10px; */
            padding-top: 10px;
        }
    </style>

</head>

<body>
    <table width="100%">
        <tr>
            @foreach ($customerData as $c)
                <td class="text-center">
                    {!! DNS1D::getBarcodeHTML("$c", 'C93', 1.8, 30) !!}
                    {{ $c }}
                </td>
                @if ($no++ % 3 == 0)
        </tr>
        <tr>
            @endif
            @endforeach
        </tr>
    </table>
</body>

</html>
