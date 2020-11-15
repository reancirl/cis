<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }} | @yield('title') </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css"
          integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog=="
          crossorigin="anonymous"/>

    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="https://upload.wikimedia.org/wikipedia/commons/6/6d/Diocese_of_Iligan_Coat_of_Arms.jpg"/>

    @yield('third_party_stylesheets')

    @stack('page_css')
    <style type="text/css">
        hr {
            border: 0.1px solid #000;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Main Header -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAsLCxERER0RER0wKSIoRSowPDA5NCgwMiUwOTQpLTI5MTAmJiUwJSUlJTAwMCUlJSUlJCUlJSUlJSUlKCUiJCUBCgcHEhURFxUVFRUXFxYVFxUVFRUVFRUVFRUWHRUdHRUdFRUWHxYdFR0VFRUdKR0eICUlJSUVFi0wNyMvHyUlJf/AABEIAMgAyAMBIgACEQEDEQH/xAAbAAACAwEBAQAAAAAAAAAAAAADBAACBQYBB//EADUQAAEEAQIDBgQFBQADAAAAAAEAAgMRIQQxBRJBE1FhcYGRIqGxwQYjMtHwFEJS4fEkM3L/xAAaAQACAwEBAAAAAAAAAAAAAAAAAQIDBAUG/8QAKREAAgIBBAIABgIDAAAAAAAAAAECEQMEBSExEkETIjJRYYFxkRRywf/aAAwDAQACEQMRAD8A4cRk5UDywqschCu8BwsJiLMfZTzAau0lHFzUm6LcWgR7yiiFQgtCJVIL3WKQBZj7ItNtIKzGk3QCb5wxoLigcYNukHP6t1dx62kpJCKIHS/nj5Z9V415O5UHkSNuHa5Pluh8EbkpSX9W6qVRyj8Y0rZ17kGM1bBEjIckXIJJTWQhPakupGjIOUr0uxQWSZnjYr1usOA4KSnZkzaNr8mu0nCs52NktHI1zbYUw0jlJUjOABcc0hvYb3TFgNKCD3oELuBXvPSu49EBwNEoGXY/qiF/UpVhzSIWFAFi/rSi8IsKIAACF611FeNItVdd7IAbY+tiiXexSbTRyU3GRuECCxC7BUfQwqOkdYpFIOTSAPI2Ws+SQuefZacIDDRSztODO1g/uI+ZpRmbNA1bsJqiO1IHQNHsAD8wVVoVCed7nDqSfc2jtaqX2dnF0j0BUcEakJwSJti7kFyO5AcmiuYu5LPTLku8KaMectp5Sx4ryW019CiVgsHxD0+q2HsIsEKaOdqFyHDwUOryl23as5xApSKS69kFtCXD/FR8lhAEjFuTbM2s1riMpiKQg7pAEIs2orUDkqJgKAdyKASrMipGawBAA2x4shFFNGFGizlNCAOGECF4mc1kp1h+EAKjYy3Cu0UdkAeCI3YKDKPzwSdg4+wJHzATwcKSupGHvPQAe7h9gUpGjSOpGfHhONKUaEyxZzvR6DoLwi2gvQDAOS7kdxQHIK5i7ku5HeEu5WIyZiMHxD0+q6OJm9hc6z9bfT6rpW8wCnA5+o7F5W1sky01aelNnCo4BorvTKTOcCo0YVnDoq84CABkUrAm1VxteNJQMdYLUQI3G8qIEaBjVaAoJg7GkuAXCgmIOwC8hPtAGyVgZVcybEfVAEIaquYKVOz+IOtVfJWAUDKSSADZbvEuHRRaBzzvTT63/v5rAZF2j2tJ7h7ldN+IYXf0biD+mj7f8VmOFxZHzqUTjGhX7Vg3KzIhNqHENGFu6Lhj21bf5t91jnSOzHWN9ITdrGCqB7kB2tF/p+ib1eglikDwPH/qzZdOQ6yEQaKcmoyfcu7Vt6hDOpjPVNyaZ0sQcG/zxCyJI+U0pQojPVTQyXg7FAcgEKc5Cl4EP8u+0Hj/AFt8x9V0T3nuXNxEF7a7x9V05isWpIpzu6Awxl1klEfHhXBAaQAh8x5SSmUmfI3uCWczqnZDuk3IAGGlXDD3IjAaukW+9AFGMFqKCQWogB12oAbgK8Lwdkq5pyAExDGaohAGiw7BEJNIDWgC7S0uoLD8JTEFe54OFWxXMcIbda52AE2BdWEAOcMhbJOwjvv2z9lvccNaSUHuP2SXBIiZwe4E/b7p/jlf0knkPv8A6WjFxFlOT6kclwCIBjjS6+ONopYGhhEMTR6rajJNLkZp3I7mCFRVjD9PG8EEeCQn4dG5oaOi0w3G6A4EFRtk6Rmf0DGfpWLreFtJJC65zLFrI1QItEZtCeNNHG6jhwAtpWM9hByutncaOFz2oZYJC04cjfZkz4UuhOCu0bZ6j6rsg8FvkuIK6zSP54GuVxlYVrmocrrwgSE3hBMhG5TIhJRQwUny3klMF1hArqgAkb+iq5wyhE8pKCXboAuXKIQK8QM6RkRR2MAC8JAUB7kyICeQNws17Q6yCmNSC7C8i0xIygZbSRjLiVoZb+kLyKERild7sIA6T8PA2+Q+A+6Lxs/+NIzvofMA/UI3BGFuns9ST9vshcZeDCGgbkfMhaeoFEeZoyHMeQOU7IRc5mHSBqfigLwUq7hsbiQW+C4yfPJ3XC1wBh1rgaEnMtmObmFrGg4MGuHKK6roIowwVSJvngeODrkz59eG2FjTa2dx+BloupZzTm+iU1eldyt7OSj13z5DonCiOS/Rm6jVSUQ9tLPBtaPYykkXzBKPZR2VkWimSfsx3t+IhdFpgYog0hZUUBfIStAXzctq/wA/RmlhdNlnUTuhuAvyRJGgDCqxl9FMqKEIL7KeIAGySe4ZQAOsZQXK5coQgAYUV+QqIA6J78AhQuFXaGcg4RGs5hsmIWD3XgJpl7KwhO4K9AIQB654OCrACrCoG2cqxpmQgDudEGsgbGd8D5An6lZPGJAAKPW/LIAWBFxJ4mEhJNfstqfSO1EPaA9P2ObzuB7KWTUpRphg0zcrRoaUCgjyxt3SMD6AQdVO+R4gYd9/DvXL9najwPMI3CvS8YzlaBH0VJZnRg2L8k6CzBlNTElaDdK14BHVY808rua2UmeHah7AGPKGhJjkunEbSuN1dcxpdZxDVUwrjpDZUsaKs7JGC2iEeMZJpDrbP+kZoIC0Y1bszZ50qKnoSoVHDqUJ0gyArTKeSyUKSZXrySbK8pAFaXoaV7SsCQmB7VZUVSVEAbsIuyjNBukrC+hdplrhVkpiCtAF5QyaOV6LteyPrAQBV3gUi8lz+UFGc5waSAlYzTrSAOCI6CodZKAWMcQFRwLjYV2tY3cWUmk+yUZNdHU8Nm7SBp9PZMv05svbvsuf4dMY3lvTddPG+6WHNGpHTwTuKsS0r9SSWyGnbDu377WlNotSW8zaO49vBXk04fTu5KT6h7KDcJxr2WP8Mw9f/URA84HX5bpTQsnkcHuFJrUtmmdkorJBCPJOdVwQrnlinFDTuQFYJ3Tmpm5nFxKXa0Fo91PBAo1WSugkZDiKCaMeAUpFGQ8dyddJ8VBaEq6Mc5tvkTcSSgyAAJuQAAlIvbaZEGCDgojmAC0MN8FdwvJKYAnIZ8VdzugVaKAKBRFDbwogB1lF26Y5SQQEJsZBu0Zj80CgQxG97RRUkcSMletN9UN4PegARsgilQMLRdK5BDTSCCaIJQB44OGbXnaBlBQjmwVcwihQSGN6A8058lvwTGM8rkhwfR8wkmP9vL8z/r5rUm0/MLCy6js36T6TYimaQEGUNJsrnnPkj2Sz9fIBRVaRd8SjY1MzGA5XLajVWSAVWbUvk3SRaVYofcrnkvoo9xcU9CByi0uyFzyGtGdlo6mARSNbfQD2wVdiM2oF37UF419YRHxigbS8pB2KsM5cEOOdghTUNl5GCcEq4jFE2gBTtPBUc690/wBg0i7QXQ5QAs1llMGPuKhjIyrMbeLTAq1lHzURnnk2UQIZaw1uvWRkZIXgmbat2mCUAXJ/xVHE7hQTADZKv1BccJWMLz1uqucFOzJFlDLa3QOMbI2KzdpjnbEKKWDyNlQgmyq55kuEb9LtrfMj6F+C4xJFM94vmIHsL+619Xw10RLmi2/TzXKfhDiX9POdPIcPqv8A62Hvt7L6oAm4KSKszcJfg+eSQjqEhPoo3ZpfQNVwmOW3M+E/L2XNanQSxGpB+3us88LRbDNGRyMmjaNgvdNwiWd9Rt/YeZXZabgxfT5sN+Z/ZbXYhjAyNtD+b96sw4m+WV5cyXCOVj4XHpm/Dl3U/sOgXM/iOEdk13UH6gr6DqWADK+d/iCZssohaf05P88vqtDpIrwwcpUc/Fqj+mT+ea0OzHKHWsho/MITALostVXxPRdPb202vRpNkAFAKgAS/bA7ilGvJNBTTsxzxtOmhkt6gqzGNA3Qy40LVQ53QJkQ8mBskebIJR3BxS0gI3KYDE1EAhRVYBQBUQIIWgLxzzsESV7UXhelM84DfPwxsqs+ZRi2/RbgwuUkkNR8JkljD4zbv8dj6Xusx0JY4teKK+is0xE3I82N818uoQdZpYZvy3fH3f5DyOx8iuXi3Zp88p8nVy7RF0os4LtDsFQ2d1tT8Iez/wBJ5vDZw8x19FkEEEgha1qlLpmnT7fGPrkoQvWjKhCgGU7NFF2uLXAtPivs/BeIDV6Zsp/VsfAj99/VfFdx5LtPwbrQyd0BOHix5gX9LV2CfNHO3TDatej6cFxvGvxAIdW3TxkfDkk7AkY+X1XR8Q1o0umknd/aL8zsPc0vhMsz3udK82XEk+Nmyrzjn2/T66LURCaNwI2x4bpabVWeRgXzf8KcTMc7tM44kyPBw29xY8wF9DjYK5yfFNEjH41qxpojId+gXzVz3OcS45OfmtfjXEhrNQXN/Q3A8dwsZg3Kz5slnY0Gn8Vb7YmB+cmZBdBBA/NKYcLI9/57qtsvxR4f+wKRuB6K7XOjyBa9eMj3+SjgawhZKFmwRlaaH4pGyJprAlYuEamanRsrxOPqt7S8PbGQJX87v8W/c/8AEp7jBLl8nPybVLy+XlGPVZpCl5TVhdBxWGQND3UAMco6eqwOQEqej1amrRm1elcHTdiL7DrCib5ATRUWgziTY3vIAHguv0+nfpGNLfHPeTv7dLWVw6FwIf1N16b/ALX5roY2xhoMvNe1bX5e64256q5KK6R6DZNJ4rza7GtRK5oa14Didjt3bomnie5xa81XQV6+KjSA1rg62noRZHl5JaRtSBofd71/MLnpcHQStV0MMjYx72PPwjYZ+R/ZBm0cU1kix3nB9Hbn1R5jKHiNp8nEWfeqVtJE199qbIJHgb7gcIjNpWmJ9W2c1qODEZid6HHsdiseaCSJ1SNpd5ExsZexzSfCsV4DZNx6NkliVnw9xyPOuhWiG4td8oryTR8vackIkMronhzDRGR06/ZdVxD8PxhxdAa88j3GR6rmdXpJoCO1bX38jsV0NNq1LlMyzmpRaXo+j8Wjn4rw1rNObPwk9AaF/U/JfJnktaWuFEYPhW67vgPH2aTTytl/sFjxJIA+o+a4eeZ8/PNIficST6myuh5Wjh5MbUmhzgmgmnna+PobHpk15Y912/4s1j4NO2BhrnsnvxXys/Jc/wDg3iMUE7mTmhRIPdWT7rO4hrHa3UmX+3YD1x+/qo5MiSL9JgbkIEU0D1VmjC1ouDTOp85DB47nyAz70t9nBoIGB5aXn2Ht3edrmZ9xhHi7Z2sbTdI4ZsL3v+BpN92Vsw8D1MlOcOUeOPluup5phGXM5WN3xnbfbCWZI147SRrnN7z3+ACzT3KTXC/6Ww0/fJns4RpWH8x5ee5v+r+y0Y+ziPJCxrOmcu9hn3KJBNI0ExkOHcMH0HsiaXTxx8xlABdeMHHgs2TPJ3bst+EldgLt9S8zm5yNsb2G9PMq0EDJpHG/yxsMgfKrpJkFrTNG6hdAC80evd3pqd57Jss7j5DHiLv+YSa+z74G4fYyeJc7OYxklgwbN2eteKyi80CFuS6Y9m7tTh1HODd93kufe/leG0ultuVJ0crecSav7BmtsKLwPbWCouucM6pkdPYyEWKq9wM5z30jPc8tALstNXj0wN1FF5SDuR7HGqpGg/RPc3mcbdjy7/mqERx4dH8R6dPTp7KKJYZN9lEMjb5CcoaGhpIDunUeR6BJ9jGJQ27b5+mVFFbj9/sngk+f2dFGwBoA/nqvJZWxgFyiixQ5lyc3NN8iLJCWFzKaN85u+/zXE8b17zIYGCm4x0PX06KKLq6GC8mZsEuTEn072U2VtdcV9Ak3DJaNlFF1MM3RdLGn2esLrAaKC6fg0L4o3TkUOh3PpjHmoos25ZH4fsF9L/g2myANuWMi/wC7c7e46LVYIpog0HmGB8utdVFFwtQvlv35D0mR+S/gUfw/lxE4gG76+3d1Sh1sbICyIHagaoHyI69V6opaV+S5Ovh5qxU6VxDHQA5zzX7ous7NjgxoBcccxO3TPcfFRRWRncv7LISt/wBl429kezhcPiz3gUM0epQD2E9tdISe/p6BeqKUfbBoy3RyuBc0ktab87waJ8AMLIiF8wG3j81FFrxz7/Rj1ysPGGkHGdlFFF2sT+VHmsqps//Z"
                         class="user-image img-circle elevation-2" alt="User Image">
                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- User image -->
                    <li class="user-header bg-primary">
                        <img src="https://infyom.com/images/logo/blue_logo_150x150.jpg"
                             class="img-circle elevation-2"
                             alt="User Image">
                        <p>
                            {{ Auth::user()->name }}
                            <small>Member since {{ Auth::user()->created_at->format('M. Y') }}</small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                        <a href="#" class="btn btn-default btn-flat float-right"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sign out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Left side column. contains the logo and sidebar -->
@include('layouts.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content">
            @yield('content')
        </section>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>CIS v.2</b>
        </div>
        <strong>Copyright &copy; 2020 <a href="https://reancirl.life" target="_blank">Reancirl Balaba</a>.</strong> All rights
        reserved.
    </footer>
</div>

<script src="{{ mix('js/app.js') }}" defer></script>
@include('layouts.include.scripts')

@yield('scripts')
</body>
</html>
