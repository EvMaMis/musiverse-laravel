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
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <script src="{{asset('js/index.js')}}" defer></script>
    <title>MusiVerse</title>
@endsection

@section('navbar')
    <ul class="d-flex">
        <li class="nav-item">
            <a class="nav-link" href="#">Main</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#advantages">Advantages</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#try">Try Now</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#contacts">Contacts</a>
        </li>
    </ul>
@endsection

@section('header')
    <div class="header">
        <div class="container" style="padding-top: 100px;">
            <div class="row justify-content-between align-items-center d-flex flex-row-reverse flex-sm-row-reverse">
                <div class="col-12 col-md-8 col-lg-6">
                    <img class="img-fluid" src="{{asset('images/img1.png')}}" alt="playlists image">
                </div>
                <div class="offer col-md-4 col-12">
                    <div class="h1 text-center">Discover a whole new world of music</div>
                    <div class="offer-hint" style="font-size: 1rem;">
                        A lot of musical masterpieces await you. Join us on an adventure to the land of new discoveries!
                    </div>
                    <div class="btn-try p-3 d-none d-md-block text-center w-100S">
                        Want to try? Register now
                    </div>
                    <div class="btn-try p-3 d-md-none">Try Now</div>
                </div>

            </div>
        </div>
    </div>

@endsection


@section('main')
    <div class="advantages" id="advantages">
        <div class="container">
            <h1>Our advantages</h1>
            <div class="photos d-flex row flex-md-row row-cols-md-2 row-cols-lg-3 flex-column justify-content-center align-items-center align-items-md-baseline align-items-lg-center mt-5">
                <div class="photo col mb-5 mb-lg-0">
                    <img src="{{asset('images/gallery_img1.png')}}" alt="playlists">
                    <div class="photo-description">
                        Create your own playlists
                        and discover new one
                    </div>
                </div>
                <div class="photo col mb-5 mb-lg-0">
                    <img src="{{asset('images/gallery_img2.png')}}" alt="Anywhere and Anytime">
                    <div class="photo-description">
                        Listen to your favorites on any platform
                    </div>
                </div>
                <div class="photo col mb-5 mb-lg-0">
                    <img src="{{asset('images/gallery_img3.png')}}" alt="No ads" style="scale: 1.5;">
                    <div class="photo-description">
                        Never get distracted by any ads. It's completely free
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="try" id="try">
        <div class="container">
            <div class="text-center"><h1>Ready to hop in?</h1></div>
            <div class="btns">
                <div class="btn-start">
                    <a href='{{route('register')}}'>
                    Create account
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <div class="contacts" id="contacts">
        <div class="container">
            <h1>Have questions? Need assistance?</h1>
            <div class="form">
                <h2>Let's keep in touch</h2>
                <form action="process">
                    <input type="text" id="name" name="name" placeholder="Your name">
                    <input type="email" id="email" name="email" placeholder="Email">
                    <textarea name="message" placeholder="Message..." rows="7"></textarea>
                    <div class="btn-submit">
                        <input type="submit" id="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
