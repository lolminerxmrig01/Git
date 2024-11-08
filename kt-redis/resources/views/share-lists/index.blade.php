@extends('app')
@section('section_name', 'Share Data Users')
@section('buttons_right')

@endsection
@section('content')
<div>

  <div class="mt-8 bg-white py-5 shadow overflow-hidden sm:rounded-md">
    <div class="px-3 flex items-center justify-between flex-wrap sm:flex-no-wrap">
    <div class="flex inline-flex items-center">
      <div class="flex inline-flex items-center">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
			Share Data Users
        </h3>
      </div>
    </div>
  </div>
<div class="mt-4 flex flex-col">
      <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-6">
        <div class="align-middle inline-block min-w-full  overflow-hidden sm:rounded-lg">
          <table class="min-w-full">
            <thead>
              <tr>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                  User
                </th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wide"></th>
              </tr>
            </thead>
            <tbody class="bg-white">
              @foreach($users as $user)
              <tr>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 block">
                  <div class="text-sm leading-5 font-medium text-gray-900">
                    <span class="px-2 inline-flex  leading-5 font-semibold rounded-full">
                      {{ $user->name }}
                    </span>
                  </div>
                </td>
                <td class="px-6 py-4 text-right whitespace-no-wrap border-b border-gray-200">
                  <a href="{{ route('share-lists.show', $user) }}" class="text-red-600 hover:text-red-900">Assign Lists</a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>
@endsection
