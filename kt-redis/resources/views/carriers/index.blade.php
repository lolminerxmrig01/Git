@extends('app')

@section('buttons_right')
<span class="ml-3 shadow-sm rounded-md">
  <a href="{{ route('campaigns.index') }}" type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-gray-600 hover:bg-gray-500 focus:outline-none focus:shadow-outline-gray focus:border-gray-700 active:bg-gray-700 transition duration-150 ease-in-out">
    {{ __('Go Back') }}
  </a>
</span>
@endsection

@section('content')
<div class="bg-white py-5 shadow overflow-hidden sm:rounded-md">

  <div wire:init="load" class="flex flex-col">
	  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
		<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
		<div class="flex justify-end mt-4 mr-2">
		  <x-dropdown variable="dlrStatusOpen" name="{{ request('filter') ?? 'Today' }}">
			  <a href="{{ route('carriers.index') }}?filter=Today" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900">Today</a>
			  <a href="{{ route('carriers.index') }}?filter=Yesterday" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900">Yesterday</a>
			  <a href="{{ route('carriers.index') }}?filter=Week" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900">Week</a>
			  <a href="{{ route('carriers.index') }}?filter=24 Hours" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900">24 Hours</a>
			  <a href="{{ route('carriers.index') }}?filter=7 days" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900">7 days</a>
			  <a href="{{ route('carriers.index') }}?filter=Month" class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 hover:text-gray-900 focus:outline-none focus:bg-gray-100 focus:text-gray-900">Month</a>
		  </x-dropdown>
		</div>
		  <div class="p-4 overflow-hidden border-b border-gray-200 sm:rounded-lg">
			<h3 class="text-lg leading-6 font-medium text-gray-900">
			Carriers Stats
			</h3>
			<table class="min-w-full divide-y divide-gray-200">
			  <thead>
				<tr>
				  <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
					Carrier
				  </th>
				  <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
					Total Sent
				  </th>
				  <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
					Delivered
				  </th>
				  <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
					Failed
				  </th>
				</tr>
			  </thead>
			  <tbody>
				  @foreach ($stats as $stat)
					<tr>
					  <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
						{{ $stat['carrier'] }}
					  </td>
					  <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
						{{ $stat['total'] }}
					  </td>
					  <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
						{{ $stat['delivered'] }}
					  </td>
					  <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
						{{ $stat['failed'] }}
					  </td>
					</tr>
				  @endforeach
				<!-- More rows... -->
			  </tbody>
			</table>
		  </div>
		</div>
	  </div>
	</div>
</div>
@endsection
