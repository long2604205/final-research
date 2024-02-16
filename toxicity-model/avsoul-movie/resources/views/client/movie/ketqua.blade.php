<!DOCTYPE html>
<html>
<head>
    <title>Comment Prediction Result</title>
</head>
<body>
    <h1>Comment Prediction Result</h1>
    @if(isset($result))
        <p>Toxic: {{ $result['toxic'] ? 'Yes' : 'No' }}</p>
        <p>Other Labels: {{ implode(', ', $result['other_labels']) }}</p>
    @endif
</body>
</html>
