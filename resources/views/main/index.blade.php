@extends('layouts.main')
@section('head_meta')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;800&family=Roboto&display=swap"
          rel="stylesheet">
    <link rel="icon" href="{{asset('images/icon.png')}}">
    <script src="{{asset('js/index.js')}}" defer></script>
    <title>MusiVerse</title>
@endsection

@section('navbar')
    <ul class="d-flex">
        <li class="nav-item">
            <a class="nav-link" href="#">Главная</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#advantages">Преимущества</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#try">Попробовать</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#contacts">Контакты</a>
        </li>
    </ul>
@endsection

@section('header')
    <div class="container">
        <div class="row">
            <div class="offer">
                <h1>Откройте для себя новый <br>мир музыки</h1>
                <div class="offer-hint">
                    Миллионы музыкальных композиций
                    <br>для ваших открытий. Вперед, в мир
                    <br>новых открытий!
                </div>
                <div class="btn-try">
                    Попробовать сейчас
                </div>
            </div>
            <img src="{{asset('images/img1.png')}}" alt="playlists image">
        </div>
    </div>
@endsection


@section('main')
    <div class="advantages" id="advantages">
        <div class="container">
            <h1>Наши преимущества</h1>
            <div class="photos">
                <div class="photo">
                    <img src="{{asset('images/gallery_img1.png')}}" alt="playlists">
                    <div class="photo-description">
                        Добавляйте свои плейлисты
                        и знакомьтесь с новыми
                    </div>
                </div>
                <div class="photo">
                    <img src="{{asset('images/gallery_img2.png')}}" alt="Anywhere and Anytime">
                    <div class="photo-description">
                        Слушайте любимую музыку на любой платформе
                    </div>
                </div>
                <div class="photo">
                    <img src="{{asset('images/gallery_img3.png')}}" alt="No ads" style="scale: 1.5;">
                    <div class="photo-description">
                        Никогда не отвлекайтесь от прослушивания Никакой рекламы
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="try" id="try">
        <div class="container">
            <h1>Готовы присоединиться?</h1>
            <div class="btns">
                <div class="btn-start">
                    Открыть новый мир
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <div class="contacts" id="contacts">
        <div class="container">
            <h1>Остались вопросы?</h1>
            <div class="form">
                <h2>Свяжитесь с нами прямо сейчас!</h2>
                <form action="process">
                    <input type="text" id="name" name="name" placeholder="Ваше имя">
                    <input type="email" id="email" name="email" placeholder="Email">
                    <textarea name="message" placeholder="Сообщение..." rows="7"></textarea>
                    <div class="btn-submit">
                        <input type="submit" id="submit" value="Подтвердить">
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endsection
    </body>

    </html>
