<x-app-layout>
    <x-slot name="title">Checkout & Orders List</x-slot>
    <x-slot name="header">🛒 Checkouts & Orders</x-slot>

    @push('styles')
    <style>
        .filter-form {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            align-items: center;
        }
        .filter-select {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            color: var(--text-main);
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            outline: none;
        }
        .filter-select option {
            background: #111;
            color: #fff;
        }
        .filter-btn {
            background: rgba(59,183,126,0.15);
            border: 1px solid rgba(59,183,126,0.4);
            color: var(--ev-green);
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s;
        }
        .filter-btn:hover {
            background: rgba(59,183,126,0.3);
        }
        .table-wrap {
            overflow-x: auto;
        }
        .order-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }
        .order-table th {
            padding: 12px 15px;
            background: rgba(255,255,255,0.03);
            text-align: left;
            color: var(--text-muted);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 0.75rem;
            border-bottom: 1px solid var(--glass-border);
        }
        .order-table td {
            padding: 12px 15px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            color: var(--text-main);
            vertical-align: middle;
        }
        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
        }
        .badge-success { background: rgba(59,183,126,0.15); color: #3bb77e; }
        .badge-failed { background: rgba(252,129,129,0.15); color: #fc8181; }
        .badge-pending { background: rgba(246,173,85,0.15); color: #f6ad55; }
        .badge-processing { background: rgba(99,179,237,0.15); color: #63b3ed; }
    </style>
    @endpush

    <div class="max-w-7xl mx-auto px-2 lg:px-0 pb-12">
        
        <form method="GET" action="{{ route('admin.orders.index') }}" class="filter-form bg-glass border border-glass-border rounded-xl p-4">
            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-text-muted mr-2">Payment Status:</label>
                <select name="payment_status" class="filter-select">
                    <option value="">All</option>
                    <option value="success" {{ request('payment_status') == 'success' ? 'selected' : '' }}>Success</option>
                    <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Failed</option>
                    <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                </select>
            </div>
            <div>
                <label class="text-[10px] font-black uppercase tracking-widest text-text-muted mr-2">Order Status:</label>
                <select name="status" class="filter-select">
                    <option value="">All</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <button type="submit" class="filter-btn">Filter</button>
            @if(request()->has('payment_status') || request()->has('status'))
                <a href="{{ route('admin.orders.index') }}" class="text-xs text-text-muted hover:text-white underline ml-3">Clear</a>
            @endif
        </form>

        <div class="bg-glass border border-glass-border rounded-xl p-6">
            <div class="table-wrap">
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Service/Charger</th>
                            <th>Amount</th>
                            <th>Payment</th>
                            <th>Order Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>
                                <strong>{{ $order->order_number }}</strong>
                                @if($order->bayarcash_transaction_id)
                                    <div style="font-size:0.65rem; color:#aaa; margin-top:3px;">Trx: {{ $order->bayarcash_transaction_id }}</div>
                                @endif
                            </td>
                            <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                            <td>
                                <div>{{ $order->customer_first_name }} {{ $order->customer_last_name }}</div>
                                <div style="font-size:0.7rem; color:#aaa;">{{ $order->customer_email }}</div>
                            </td>
                            <td>
                                @if($order->service)
                                    <span style="color:#63b3ed">Service:</span> {{ $order->service->title }}
                                @elseif($order->charger)
                                    <span style="color:#3bb77e">Charger:</span> {{ $order->charger->name }}
                                @else
                                    -
                                @endif
                            </td>
                            <td><strong>RM{{ number_format($order->total_price, 2, '.', ',') }}</strong></td>
                            <td>
                                @if($order->payment_status == 'success' || $order->payment_status == 'paid')
                                    <span class="badge badge-success">Success</span>
                                @elseif($order->payment_status == 'failed')
                                    <span class="badge badge-failed">Failed</span>
                                @else
                                    <span class="badge badge-pending">{{ $order->payment_status ?: 'Pending' }}</span>
                                @endif
                            </td>
                            <td>
                                @if($order->status == 'completed')
                                    <span class="badge badge-success">Completed</span>
                                @elseif($order->status == 'cancelled')
                                    <span class="badge badge-failed">Cancelled</span>
                                @elseif($order->status == 'processing')
                                    <span class="badge badge-processing">Processing</span>
                                @else
                                    <span class="badge badge-pending">Pending</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="text-[11px] font-bold text-[#63b3ed] hover:text-[#4299e1] underline px-2 py-1 bg-[#63b3ed]/10 rounded-md">View Details</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" style="text-align:center; padding:30px; color:#aaa;">No checkouts found matching criteria.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $orders->links('pagination::tailwind') }}
            </div>
        </div>
    </div>
</x-app-layout>
