@extends ('facades.main')

@section ('content')

	<div class="flex-center position-ref full-height">

		<div class="content">
				<p>Задача номер: {{$task->id}}</p>
			<br>
			<p>
			   Статус вашей задачи: {{$status}}
			</p>
			<br>
			<a href="/">
				Вернуться на главную
			</a>
			<br>
			<img class="logo m-t-md" src="/img/logo.jpg" alt="">

		</div>
	</div>
@endsection