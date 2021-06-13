@extends ('facades.main')

@section ('content')
<div class="flex-center position-ref full-height">
    <div class="container">
    </div>
    <div class="content">

        <div class="title m-b-md">
            Mospolytech
        </div>
        <form id="form" class="form" action="">
            <label>Введите номер задачи
                <input name="task" type="text">
            </label>
        </form>
        <div class="content hide" id="error">
            <p>Ошибка. Введите номер задачи.</p>
        </div>

        <img class="logo m-t-md" src="/img/logo.jpg" alt="">

    </div>
</div>
@endsection