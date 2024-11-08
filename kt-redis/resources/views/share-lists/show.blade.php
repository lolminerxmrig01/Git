@extends('app')
@section('section_name', "$suser->name Lists")
@section('content')

<div class="mt-8 bg-white py-5 shadow overflow-hidden sm:rounded-md">
  <form method="POST" action="{{ route('share-list.store') }}" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="user_id" value="{{ $suser->id }}" />
	<table class="min-w-full">
		<thead>
		  <tr>
			<th class="px-1 py-3 border-b border-gray-200 bg-gray-50 text-center text-xs leading-4 font-medium text-gray-500 uppercase tracking-wide"><input type="checkbox" name="" id="checkAll" /></th>
			<th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
			  NAME
			</th>
			<th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
			  LEADS
			</th>
		  </tr>
		</thead>
		<tbody class="bg-white">
		  @foreach($catalogs as $catalog)		  
		  <tr>
			<td class="px-1 py-4 text-center whitespace-no-wrap border-b border-gray-200">
				@if(in_array($catalog->id,$lists))
					 <input type="checkbox" name="saveuserlists[]" checked value="{{ $catalog->id }}" />	
				@else
					 <input type="checkbox" name="saveuserlists[]" value="{{ $catalog->id }}" />	
				@endif
			 
			</td>
			<td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 block">
			  <div class="text-sm leading-5 font-medium text-gray-900">
				<span class="px-2 inline-flex  leading-5 font-semibold rounded-full">
				  {{ $catalog->name }}
				</span>
			  </div>
			</td>
			<td class="px-1 py-4 text-left whitespace-no-wrap border-b border-gray-200">
			  <div class="text-sm leading-5 font-medium text-gray-900">
				<span class="px-2 inline-flex  leading-5 font-semibold rounded-full">
				  {{ $catalog->leads_count }}
				</span>
			  </div>
			</td>			
		  </tr>
		  @endforeach
		</tbody>
		<tfoot class="bg-white">
			<tr>
				<td colspan="3" align="center">
					<button type="submit" class="inline-flex items-center px-6 py-2 border border-transparent text-sm leading-5 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-700 active:bg-blue-700 transition duration-150 ease-in-out">Save</button>
				</td>
			</tr>
		</tfoot>
	  </table>
	
  </form>
</div>

@endsection

@section('scripts')
<script>
 $("#checkAll").click(function () {
     $('input:checkbox').not(this).prop('checked', this.checked);
 });
</script>
@endsection
