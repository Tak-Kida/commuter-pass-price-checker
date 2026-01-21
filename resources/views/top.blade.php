<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
</head>

<body>
    <h1>きっぷと定期券、どちらが安いか計算します</h1>

    <input type="text" name="origin" placeholder="出発地を入力">
    <input type="text" name="destination" placeholder="目的地を入力">

    <input type="number" name="ticket_price" placeholder="片道分の切符の値段を入力">
    <input type="number" name="subscription_price" placeholder="定期券の値段を入力">

    <input type="number" name="subscription_start_date" placeholder="利用開始日を入力">
    <input type="number" name="subscription_end_date" placeholder="利用終了日を入力">

    <input type="submit" value="計算" id="send-calc-button">

    @if (isset($cheaper_kind))
        <div id="result">
            <h3>結果</h3>
            <p>{{ $cheaper_kind }} の方が安いです。</p>
        </div>
        <div id="additional_info">
            <h3>追加情報</h3>
            <p>利用期間中の平日の日数： {{ $additional_info['weekdays'] }} 日</p>
            <p>期間中の切符の値段合計： {{ $additional_info['ticket_price_sum'] }}円</p>
            <p>定期券の値段： {{ $additional_info['subscription_price'] }}円</p>
        </div>
    @endif
</body>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    console.log('script loaded');

    const calcRequestUrl = 'http://localhost:8000/api/calc';
    const data = {
        start_date: '2026-01-01',
        ticket_period_month: 1,
    };
    const sendCalcButton = document.getElementById('send-calc-button');

    async function sendCalc() {
        const response = await axios.post(calcRequestUrl, data);
        console.log(response.data);
    }

    sendCalcButton.onclick = () => {
        console.log('sendCalcButton clicked');
        sendCalc();
    }
</script>

</html>
