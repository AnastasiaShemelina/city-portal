<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            {{__('Редактирование заявки')}}
        </h2>
    </x-slot>
    <form action="{{route('admin-update-submit', $data->id)}}" class="max-w-7x1 mx-auto sm:px-6 lg:px-8 mt-8" method="post">
    @csrf

    <div class="form-group pt-2">
        <label for="name">Имя</label>
        <input type="text" name="name" value="{{$data->name}}" placeholder="Your name" id="name" class="form-control">
    </div>

    <div class="form-group pt-2">
        <label for="name">Email</label>
        <input type="text" name="email" value="{{$data->email}}" placeholder="Your e-mail" id="email" class="form-control">
    </div>

    <div class="form-group pt-2">
        <label for="subject">Тема заявки</label>
        <input type="text" name="subject" value="{{$data->subject}}" placeholder="Тема заявки" id="subject" class="form-control">
    </div>

    <div class="form-group pt-2">
        <label for="message">Текст заявки</label>
        <textarea type="text" name="message" placeholder="Текст заявки" id="message" class="form-control">{{$data->message}}</textarea>
    </div>

    <input type="submit" class="btn btn-success mt-2" value="Update">
    </form>
</x-app-layout>