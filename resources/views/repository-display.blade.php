<head>
    <title>Github Repository</title>
    <link rel="stylesheet" href="/css/app.css">
</head>

<div id="app">
    <repository
        name="{{ $name }}"
        error="{{ session()->get('error') }}"
        :repositories="{{ json_encode($repositories) }}">
    </repository>
</div>

<script src="/js/app.js"></script>