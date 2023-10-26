<!DOCTYPE html>
<!--Codingthai.com-->
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
    <!-- <link rel="stylesheet" href="style.css" /> -->
    <title>Mobile Tab Navigation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!--- FONT-ICONS CSS -->
    <link href="{{url('/')}}/assets/css/icons.css" rel="stylesheet" />

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{url('/')}}/assets/colors/color1.css" />
    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');


        .phone {

            border: 3px solid #eee;
            border-radius: 15px;
            height: 600px;
            width: 340px;
        }

        .phone .content {
            display: none;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            height: calc(100% - 60px);
            width: 100%;
            transition: opacity 0.4s ease;
        }

        .phone .content.show {
            display: block;
        }

        nav {
            position: absolute;
            bottom: 0;
            left: 0;
            margin-top: -5px;
            width: 100%;
        }

        nav ul {
            background-color: #fff;
            display: flex;
            list-style-type: none;
            padding: 0;
            margin: 0;
            height: 60px;
        }

        nav li {
            color: #777;
            cursor: pointer;
            flex: 1;
            padding: 10px;
            text-align: center;
        }

        nav ul li p {
            font-size: 12px;
            margin: 2px 0;
        }

        nav ul li:hover,
        nav ul li.active {
            color: #8e44ad;
        }
    </style>
    @livewireStyles
</head>

<body>

    <div class="phone">
        @if (Auth::user()->absen == "hadir")
        @else
        <div alt="home" class="content show">
            <livewire:absensi-saksi>
        </div>
        @endif
        <div alt="work" class="content {{Auth::user()->absen == 'hadir'?'show':''}}">
            <livewire:upload-c1>

        </div>
        <div alt="blog" class="content ">
            <livewire:surat-suara>
        </div>
        <div alt="blog" class="content ">
            <livewire:clainnya>
        </div>




        <nav class="position-fixed">
            <ul>
            @if (Auth::user()->absen == "hadir")
        @else
                <li class="active">
                    <i class="fas fa-home"></i>
                    <p>Absensi</p>
                </li>
                @endif
                <li>
                    <i class="fas fa-box"></i>
                    <p>Upload C1</p>
                </li>
                <li>
                    <i class="fas fa-book"></i>
                    <p>Surat Suara</p>
                </li>
                <li>
                    <i class="fas fa-book-open"></i>
                    <p>Upload Cn</p>
                </li>

            </ul>
        </nav>
    </div>


    @livewireScripts
    <script>
        const contents = document.querySelectorAll('.content')
        const listItems = document.querySelectorAll('nav ul li')

        listItems.forEach((item, idx) => {
            item.addEventListener('click', () => {
                hideAllContents()
                hideAllItems()

                item.classList.add('active')
                contents[idx].classList.add('show')
            })
        })

        function hideAllContents() {
            contents.forEach(content => content.classList.remove('show'))
        }


        function hideAllItems() {
            listItems.forEach(item => item.classList.remove('active'))
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>