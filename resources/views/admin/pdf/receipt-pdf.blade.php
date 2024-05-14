<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $title }}</title>

    <style>
        * {
            padding: 0;
            margin: 0;

        }

        body {
            margin: 0.7in 1in;
        }

        @font-face {
            font-family: 'Noticia Text';
            src: url({{ storage_path('fonts/NoticiaText-Regular.ttf') }}) format("truetype");
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: 'Noticia Text';
            src: url({{ storage_path('fonts/NoticiaText-Bold.ttf') }}) format("truetype");
            font-weight: 700;
            font-style: normal;
        }

        main {
            font-family: 'Noticia Text';
        }

        .w-full {
            width: 100%;
        }

        .brand-logo {
            display: flex;
            align-items: center;
        }

        .logo {
            max-width: 56px;
            width: 100%;
        }

        .info {
            font-family: 'serif';
            line-height: 1.5;
            text-transform: uppercase;
        }

        .title {
            font-size: 1.2rem;
            letter-spacing: 0.05em;
        }

        .subtitle {
            font-size: 0.875rem;
            letter-spacing: 0.05em;
        }

        .text-end {
            text-align: right;
        }
    </style>
</head>

<body>
    <header>
        <table class="w-full">
            <tr>
                <td style="width: 56px; padding-right: 5px">
                    <img src="{{ public_path('assets/images/logo-black.png') }}" class="logo" width="56px"
                        alt="Brand logo">
                </td>
                <td style="width: 100%">
                    <div class="info">
                        <p class="title">robert camba's</p>
                        <p class="subtitle">catering services</p>
                    </div>
                </td>
                <td style="text-align: left; min-width:180px">
                    <p>Date submitted:</p>
                    <span>{{ $reservation->created_at->format('M d, Y - g:i A') }}</span>
                </td>
            </tr>
        </table>
        <div class="brand-logo">

        </div>
    </header>
    <main>
        <div
            style="padding: 20px; background-color: #fff; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2); border-radius: 8px;">
            <div style="text-align: center;">
                <p style="font-size: 24px; margin-bottom: 20px; font-family: 'Noticia Text' !important;">Reservation
                    Details</p>
            </div>
            <div>
                <div style="border-bottom: 1px solid #ccc; margin-bottom: 10px;"></div>
                <p style="font-size: 16px; margin: 0 20px 10px;">Transaction no.:
                    <span>{{ $reservation->transaction_number }}</span>
                </p>
                <div style="border-bottom: 1px solid #ccc; padding: 10px 0; margin-bottom: 10px;">
                    <p style=" font-family: 'Noticia Text' !important; font-size: 18px">Personal Information & Event
                        Details</p>
                </div>
                <ul style="margin: 0 20px; padding: 0; list-style-type: none; font-size: 14px;">
                    <li>
                        <p>Name: <span>{{ $reservation->user->name }}</span></p>
                    </li>
                    <li>
                        <p>Phone Number: <span>{{ $reservation->phone_number}}</span></p>
                    </li>
                    @if ($reservation->additional_number)
                        <li>
                            <p>Additional Number: <span>{{ $reservation->additional_number}}</span></p>
                        </li>
                    @endif
                    <li>
                        <p>Event Address: <span>{{ $reservation->address }}</span></p>
                    </li>
                    <li>
                        <p>Occasion: <span>{{ $reservation->occasion }}</span></p>
                    </li>
                    <li>
                        <p>Pax: <span>{{ $reservation->pax }}</span></p>
                    </li>
                    @if ($reservation->adults && $reservation->kids)
                    <li>
                        <p> - Adults: <span>{{ $reservation->adults }}</span></p>
                    </li>
                    <li>
                        <p> - Kids: <span>{{ $reservation->kids }}</span></p>
                    </li>
                @endif
                </ul>
                <div style="border-bottom: 1px solid #ccc; padding: 10px 0; margin-bottom: 10px;">
                    <p style=" font-family: 'Noticia Text' !important; font-size: 18px">Time and Date</p>
                </div>
                <ul style="margin: 0 20px; padding: 0; list-style-type: none; font-size: 14px;">
                    <li>
                        <p>Date: <span>{{ $reservation->date->format('M d, Y') }}</span></p>
                    </li>
                    <li>
                        <p>Time: <span>{{ $reservation->time->format('g : i A') }}</span></p>
                    </li>
                </ul>
                <div style="border-bottom: 1px solid #ccc; padding: 10px 0; margin-bottom: 10px;">
                    <p style=" font-family: 'Noticia Text' !important; font-size: 18px">Package Details</p>
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; margin: 0 20px; font-size: 14px;">
                    <div>
                        <p>Package: <span>{{ $reservation->package->name }}</span></p>
                        <p>Menu: <span>{{ $reservation->menu->name }}</span></p>
                        @if ($reservation->beverage)
                            <p>Beverage: <span>{{ $reservation->beverage }}</span></p>
                        @endif
                        <p>Price: ₱ <span>{{ number_format($reservation->menu->price, 2, '.', ',') }}</span></p>
                        <p>Amount Paid: ₱ <span>{{ number_format($reservation->amount_paid, 2, '.', ',') }}
                                ({{ $reservation->payment_percent }}%)</span></p>
                    </div>
                    <div></div>
                </div>
                @if ($reservation->rentals)
                    <div style="border-bottom: 1px solid #ccc; padding: 10px 0; margin-bottom: 10px;">
                        <p style=" font-family: 'Noticia Text' !important; font-size: 18px">Rentals</p>
                    </div>

                    <div class="flex justify-center">
                        <table style="width: 100%; font-size: 14px; text-align: left; font-family: 'Noticia Text">
                            <thead class="text-base font-size: 16px">
                                <td>Item Name</td>
                                <td>Quantity</td>
                                <td>Price</td>
                                <td>Total Cost</td>
                            </thead>
                            <tbody>
                                @foreach (json_decode($reservation->rentals, true) as $item)
                                    @php
                                        $inventoryItem = json_decode($item['item'], true); // Decode the nested JSON string
                                    @endphp
                                    {{-- Debugging --}}
                                    @if (!isset($inventoryItem['item_name']) || !isset($inventoryItem['price']))
                                        @php
                                            dd($item); // Dump the contents of $item for debugging
                                        @endphp
                                    @endif
                                    <tr>
                                        <td>{{ $inventoryItem['item_name'] }}</td>
                                        <td>{{ $item['quantity'] }}</td>
                                        <td>₱{{ number_format($inventoryItem['price'], 2, '.', ',') }}</td>
                                        <td>₱{{ number_format(intval($item['itemTotalCost']), 2, '.', ',') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                @if ($reservation->add_ons)
                    <div style="border-bottom: 1px solid #ccc; padding: 10px 0; margin-bottom: 10px;">
                        <p style=" font-family: 'Noticia Text' !important; font-size: 18px">Options / Additional Charge
                        </p>
                    </div>
                    <ul style="margin: 0 20px; padding: 0; list-style-type: none; font-size: 14px;">
                        @foreach (json_decode($reservation->add_ons, true) as $option)
                            <li>
                                <p>- {{ $option['option'] }}<span>
                                        (₱{{ number_format(intval($option['price']), 2, '.', ',') }})
                                    </span>
                                </p>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <div style="border-bottom: 1px solid #ccc; margin-bottom: 10px;"></div>
                <div style="text-align: right; padding-right: 20px; font-size: 16px;">
                    <p style="font-family: 'Noticia Text' !important; ">Total Cost: ₱
                        {{ number_format($reservation->total_cost, 2, '.', ',') }}</p>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
