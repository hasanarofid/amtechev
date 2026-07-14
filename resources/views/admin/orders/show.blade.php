<x-app-layout>
    <x-slot name="title">Order Details #{{ $order->order_number }}</x-slot>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.orders.index') }}" class="p-2 bg-glass border border-glass-border rounded-xl text-text-muted hover:text-white transition-all shadow-sm group flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:-translate-x-1 transition-transform">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </a>
            Order Details #{{ $order->order_number }}
        </div>
    </x-slot>

    @push('styles')
    <style>
        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .info-card {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            padding: 20px;
        }
        .info-card-title {
            font-size: 0.85rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-muted);
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 0.85rem;
        }
        .info-label {
            color: var(--text-muted);
        }
        .info-value {
            font-weight: 600;
            color: var(--text-main);
            text-align: right;
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
        .table-items {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
        }
        .table-items th {
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
        .table-items td {
            padding: 12px 15px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            color: var(--text-main);
            vertical-align: middle;
        }
    </style>
    @endpush

    <div class="max-w-7xl mx-auto px-2 lg:px-0 pb-12">
        <div class="details-grid mb-6">
            <!-- Order Info -->
            <div class="info-card">
                <div class="info-card-title">
                    <span style="font-size:1.2rem">🧾</span> Order Information
                </div>
                <div class="info-row">
                    <span class="info-label">Order Number:</span>
                    <span class="info-value">{{ $order->order_number }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Date:</span>
                    <span class="info-value">{{ $order->created_at->format('M d, Y - H:i:s') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Payment Method:</span>
                    <span class="info-value">{{ $order->payment_method ?: 'BayarCash / FPX' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Payment Status:</span>
                    <span class="info-value">
                        @if($order->payment_status == 'success' || $order->payment_status == 'paid')
                            <span class="badge badge-success">Success</span>
                        @elseif($order->payment_status == 'failed')
                            <span class="badge badge-failed">Failed</span>
                        @else
                            <span class="badge badge-pending">{{ $order->payment_status ?: 'Pending' }}</span>
                        @endif
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Order Status:</span>
                    <span class="info-value">
                        @if($order->status == 'completed')
                            <span class="badge badge-success">Completed</span>
                        @elseif($order->status == 'cancelled')
                            <span class="badge badge-failed">Cancelled</span>
                        @elseif($order->status == 'processing')
                            <span class="badge badge-processing">Processing</span>
                        @else
                            <span class="badge badge-pending">Pending</span>
                        @endif
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Transaction ID:</span>
                    <span class="info-value">{{ $order->bayarcash_transaction_id ?: '-' }}</span>
                </div>
                @if($order->payment_url)
                <div class="info-row">
                    <span class="info-label">Payment URL:</span>
                    <span class="info-value"><a href="{{ $order->payment_url }}" target="_blank" class="text-[#63b3ed] underline">View Link</a></span>
                </div>
                @endif
            </div>

            <!-- Customer Info -->
            <div class="info-card">
                <div class="info-card-title">
                    <span style="font-size:1.2rem">👤</span> Customer Details
                </div>
                <div class="info-row">
                    <span class="info-label">Name:</span>
                    <span class="info-value">{{ $order->customer_first_name }} {{ $order->customer_last_name }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email:</span>
                    <span class="info-value">{{ $order->customer_email ?: ($order->user->email ?? '-') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Phone:</span>
                    <span class="info-value">{{ $order->customer_phone ?: ($order->user->phone ?? '-') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Address:</span>
                    <span class="info-value">{{ $order->customer_address ?: '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">City:</span>
                    <span class="info-value">{{ $order->customer_city ?: '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">State & Postcode:</span>
                    <span class="info-value">{{ $order->customer_state ?: '-' }}, {{ $order->customer_postcode ?: '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Country:</span>
                    <span class="info-value">{{ $order->customer_country ?: '-' }}</span>
                </div>
            </div>
        </div>

        @if($order->notes)
        <div class="info-card mb-6">
            <div class="info-card-title"><span style="font-size:1.2rem">📝</span> Customer Notes</div>
            <p class="text-sm text-text-main leading-relaxed bg-black/20 p-4 rounded-lg">
                {{ $order->notes }}
            </p>
        </div>
        @endif

        <!-- Order Items / Product -->
        <div class="info-card">
            <div class="info-card-title"><span style="font-size:1.2rem">📦</span> Order Summary</div>
            <div style="overflow-x:auto;">
                <table class="table-items">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Type</th>
                            <th style="text-align:right">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($order->service)
                        <tr>
                            <td>
                                <strong>{{ $order->service->title }}</strong>
                            </td>
                            <td>Service</td>
                            <td style="text-align:right">RM{{ number_format($order->service->price, 2, '.', ',') }}</td>
                        </tr>
                        @endif

                        @if($order->charger)
                        <tr>
                            <td>
                                <strong>{{ $order->charger->name }}</strong>
                            </td>
                            <td>Charger</td>
                            <td style="text-align:right">RM{{ number_format($order->charger->price, 2, '.', ',') }}</td>
                        </tr>
                        @endif
                        
                        @if(!$order->service && !$order->charger && $order->items && $order->items->count() > 0)
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <strong>{{ $item->product_name ?? 'Unknown Item' }}</strong>
                                    @if($item->quantity > 1) <span class="text-xs text-text-muted">x{{ $item->quantity }}</span> @endif
                                </td>
                                <td>Product</td>
                                <td style="text-align:right">RM{{ number_format(($item->price ?? 0) * ($item->quantity ?? 1), 2, '.', ',') }}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" style="text-align:right; font-weight:bold; font-size:1rem; padding:20px 15px;">Total Price</td>
                            <td style="text-align:right; font-weight:bold; font-size:1.1rem; color:#3bb77e; padding:20px 15px;">
                                RM{{ number_format($order->total_price, 2, '.', ',') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
