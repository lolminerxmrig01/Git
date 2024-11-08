<div wire:init="load" class="flex flex-col mt-8">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="p-4 shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <h3 class="text-lg leading-6 font-medium text-gray-900">
        Carrier Breakdown
        </h3>
        <table class="min-w-full divide-y divide-gray-200">
          <thead>
            <tr>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Carrier
              </th>
              <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Total
              </th>
			  <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-green-500 uppercase tracking-wider">
                Delivered
              </th>
			  <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-green-500 uppercase tracking-wider">
                Replies
              </th>
			  <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-red-500 uppercase tracking-wider">
                Failed
              </th>
            </tr>
          </thead>
          <tbody>
			  @php
				$total_all = 0;
				$total_delivered = 0;
				$total_replies = 0;
				$total_failed = 0;
			@endphp	
              @foreach ($carriers as $carrier)			  
                <tr>
                  <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-gray-900">
                    {{ $carrier['carrier']->name }}
                  </td>
                  <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-gray-500">
                    {{ $carrier['count']['all'] }}
                  </td>
				  <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-green-500">
                    {{ $carrier['count']['delivered'] }}
                  </td>
				  <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-green-500">
                    {{ $carrier['count']['replies'] }}
                  </td>
				  <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 text-red-500">
                    {{ $carrier['count']['failed'] }}
                  </td>
                </tr>
				@php($total_all += $carrier['count']['all'])
				@php($total_delivered += $carrier['count']['delivered'])
				@php($total_replies += $carrier['count']['replies'])
				@php($total_failed += $carrier['count']['failed'])
              @endforeach
              <tr>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-bold text-gray-900">Total</td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-bold text-gray-900">{{ $total_all }}</td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-bold text-green-900">{{ $total_delivered }}</td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-bold text-green-900">{{ $total_replies }}</td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-bold text-red-900">{{ $total_failed }}</td>
              </tr>
            <!-- More rows... -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
