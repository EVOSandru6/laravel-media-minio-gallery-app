<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
</head>

<body class="antialiased">

<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
    <h3>
        Users
    </h3>

    <div class="user_uploads">
        @php $user = \App\Models\User::find(1); @endphp
        @php $allImages = $user->getMedia('avatars')->all(); @endphp
        @php // dd($allImages); @endphp
        @php $imgFull = $allImages[3]->getUrl() @endphp
        @php $imgSmall = $allImages[3]->getUrl('thumb') @endphp

        {{ $imgSmall }}

        <form action="{{route('users') }}" method="post" enctype="multipart/form-data">
            @csrf

            <input type="file" name="file"/>

            <button type="submit">
                Upload
            </button>
        </form>
    </div>
</div>
</body>
</html>
