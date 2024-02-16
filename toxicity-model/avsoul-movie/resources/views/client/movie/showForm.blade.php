<!DOCTYPE html>
<html>
<head>
    <title>Laravel Comment Prediction</title>
</head>
<body>
    <h1>Laravel Comment Prediction</h1>

    <form method="post" action="{{ route('mov.predict') }}">
        @csrf
        <label for="comment">Enter Comment:</label>
        <textarea name="comment" rows="4" cols="50"></textarea>
        <br>
        <button type="submit">Predict</button>
    </form>
</body>
</html>
