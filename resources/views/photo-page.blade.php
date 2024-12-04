<style>
    .general {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
    }

    .slogan-container {
        display: flex;
        align-items: center;
        justify-content: right;
        height: 80vh;
        text-align: left;
        font-size: 5rem;
        font-weight: bold;
        text-transform: uppercase;
    }

    .slogan {
        margin-top: 0;
    }

    .card-container {
        height: 80vh;
        margin-top: 3%;
        max-width: 300px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card {
        background-color: #212529;
        border-radius: 0.375rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-top: 5%;
    }

    .card-body {
        height: 300px;
    }

    .card-title {
        margin-top: 210px;
        font-size: 1.125rem;
        font-weight: 600;
        color: #f3f4f6;
    }

    .card-text {
        color: #e5e7eb;
    }

    .card-footer {
        font-size: 0.8rem;
        color: #bbb;
    }

    .photo-container {
        position: relative;
        box-sizing: border-box;
    }

    .photo-before,
    .photo-after {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: opacity 0.5s ease, transform 0.5s ease;
        box-sizing: border-box;
    }

    .photo-before {
        opacity: 0;
        transform: scale(1);
    }

    .photo-after {
        opacity: 1;
        transform: scale(1);
    }

    .photo-before.scale,
    .photo-after.scale {
        transform: scale(1.1);
    }
</style>

<body class="bg-dark text-white">

    <div class="general">
        <div class="slogan-container">
            <div class="slogan">СДЕЛАЕМ ЛУЧШЕ <br> ВМЕСТЕ</div>
        </div>

        <div class="card-container">
            @foreach($data as $el)
                <div class="card">
                    <div class="card-body">
                        <div class="photo-container" onmouseover="showBefore(this)" onmouseout="showAfter(this)">
                            <div class="photo-before">
                                <img src="{{ asset('storage/' . $el->photo_before) }}" alt="Фото до">
                            </div>
                            <div class="photo-after">
                                <img src="{{ asset('storage/' . $el->photo_after) }}" alt="Фото после">
                            </div>
                        </div>
                        <h5 class="card-title text-truncate">{{ $el->subject }}</h5>
                        <p class="card-text text-truncate">{{ $el->email }}</p>
                        <p class="card-text text-truncate">Категория: {{ $el->category->name }}</p>
                    </div>
                    <div class="card-footer text-muted">
                        <small>{{ $el->created_at }}</small>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Количество задач со статусом "Решена":  $ resolvedCount -->
        <div class="text-center my-4">
            <p class="card-text text-truncate"></p>
        </div>

    </div>

    <script>
        function showBefore(element) {
            const photoAfter = element.querySelector('.photo-after');
            const photoBefore = element.querySelector('.photo-before');
            photoAfter.style.opacity = '0';
            photoBefore.style.opacity = '1';
            photoBefore.classList.add('scale');
            photoAfter.classList.remove('scale');
        }

        function showAfter(element) {
            const photoAfter = element.querySelector('.photo-after');
            const photoBefore = element.querySelector('.photo-before');
            photoAfter.style.opacity = '1';
            photoBefore.style.opacity = '0';
            photoBefore.classList.remove('scale');
            photoAfter.classList.add('scale');
        }
    </script>
</body>

</html>