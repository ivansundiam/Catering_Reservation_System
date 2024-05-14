<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ $title }}</title>

    <style>
        @page{
            font-family: 'arimo';
            margin: 0.7in 1in;
        }
        *{
            padding: 0;
            margin: 0;
        }
        body{
            font-family: 'arimo';
            margin: 1.7in 1in 0.7in 1in;
        }
        @font-face{
            font-family: 'Noticia Text';
            src: url({{ storage_path('fonts/Noticia_Text/NoticiaText-Regular.ttf') }});
        }

        .w-full{
            width: 100%;
        }
        
        header{
            position: fixed;
            top: 0cm;
            left: 0cm;
            width: 100%;
            margin: 0.7in 1in;
        }
        footer{
            position: fixed;
            bottom: 0cm;
            right: 0cm;
            width: 3in; 
            font-size: 1rem; 
            margin: 0.7in 1.6in;
        }
        .sub-footer{
            position: fixed;
            bottom: 0cm;
            right: 0cm;
            width: 6in; 
            font-size: 1rem; 
            margin: 0 1in 1.6in 1in;
        }
        footer{
            position: fixed;
            bottom: 0cm;
            right: 0cm;
            width: 3in; 
            font-size: 1rem; 
            margin: 0.7in 1in;
        }

        main{
            margin: 1in 0 2.4in 0;
        }
        .page-break {
            page-break-after: always;
        }
        .brand-logo{
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
        
        .text-end{
            text-align: left;
        }

        table tr td{
            /* border: 1px black solid; */
        }

    </style>
</head>
<body>
    <header>
        <table style="width:6.3in ;border-bottom: 2px black solid; padding-bottom: 16px">
            <tr>
                <td style="width: 56px; padding-right: 5px">
                     <img src="{{ public_path("assets/images/logo-black.png") }}" class="logo" width="56px" alt="Brand logo">
                </td>
                <td>
                    <div class="info">
                        <p class="title">robert camba's</p>
                        <p class="subtitle">catering services</p> 
                    </div>
                </td>
                <td class="text-end" style="width: 20%">
                    <h3 style="font-size: 1.25rem; font-weight: bold; color: black;">Sales Report</h3>
                    <span >{{ $date }}</span>
                </td>
            </tr>
        </table>
        <div class="brand-logo">
            
        </div>
    </header>

    <footer>
        <div style="display: flex; justify-content: end; margin-top: 6rem;">
            <div style="text-align: center;">
                <p style="padding-right: 0.75rem; padding-left: 0.75rem; font-weight: bold; border-top: 1px solid black;">APPROVED BY: Robert Camba</p>
                <p style="text-transform: uppercase;">Owner</p>
            </div>
        </div>
    </footer>
    
    <div style="" class="sub-footer">
        @if ($reportDetails['date'] == 'annually')
            <table style="width: 100%; margin-top: 1rem;">
                <tr>
                    <td style="text-align: left; font-weight: bold;">TOTAL - of All <span>{{ $reportDetails['year'] }}</span></td>
                </tr>
                <tr>
                    <td style="text-align: left;">
                        <span style="font-weight: bold;">ITEMS RENTED: </span>
                        <span style="font-weight: normal;"> {{ $reportDetails['inventoryCount'] }}</span>
                    </td>
                </tr>   
                <tr>
                    <td style="text-align: left;">
                        <span style="font-weight: bold;">MOST ITEM RENTED: </span>
                        <span style="font-weight: normal;"> {{  $reportDetails['mostRentedItemYear']['inventory']['item_name'] }}<span> ({{ $reportDetails['mostRentedItemYear']['item_count'] }})</span></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">
                        <span style="font-weight: bold;">BEST MONTH: </span>
                        <span style="font-weight: normal;">{{ date('F', mktime(0, 0, 0,$reportDetails['mostMonthWithRent']['month'] , 1)) }} <span> ({{ $reportDetails['mostMonthWithRent']['item_count'] }})</span></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">
                        <span style="font-weight: bold;">TOTAL EARNINGS: </span>
                        <span style="font-weight: normal;"><span style="font-family: 'Noticia Text'">₱</span>{{ number_format($reportDetails['totalEarnings'], 2, '.', ',') }}</span>
                    </td>
                </tr>
            </table>
        @else
            <table style="width: 100%; margin-top: 1rem;">
                <tr>
                    <td style="text-align: left; font-weight: bold;">TOTAL - Month of <span>{{ date('F', mktime(0, 0, 0, $reportDetails['month'] , 1)) }}</span></td>
                </tr>
                <tr>
                    <td style="text-align: left;">
                        <span style="font-weight: bold;">ITEMS RENTED: </span>
                        <span style="font-weight: normal;"> {{ $reportDetails['inventoryCount'] }}</span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">
                        <span style="font-weight: bold;">MOST ITEM RENTED: </span>
                        <span style="font-weight: normal;"> {{  $reportDetails['mostRentedItemMonth']['inventory']['item_name'] }}<span> ({{ $reportDetails['mostRentedItemMonth']['item_count'] }})</span></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">
                        <span style="font-weight: bold;">TOTAL EARNINGS: </span>
                        <span style="font-weight: normal;"><span style="font-family: 'Noticia Text'">₱</span>{{ number_format($reportDetails['totalEarnings'], 2, '.', ',') }}</span>
                    </td>
                </tr>
            </table>
        @endif
    </div>

    <main>
        <div style="font-family: 'Times New Roman', Times, serif; color: black;">
            <div style="width: 100%;">
                <h2 style="margin-top: -5.25rem; margin-bottom: 1.25rem; font-size: 1.5rem; font-weight: bold; text-align: center; text-transform: capitalize;">
                    @if ($reportDetails['date'] == 'monthly')
                        Monthly Report - {{ date('F', mktime(0, 0, 0, $reportDetails['month'], 1)) }} {{ $reportDetails['year'] }}
                    @elseif ($reportDetails['date'] == 'annually')
                        Annual Report - {{ $reportDetails['year'] }}
                    @else
                        Overall Report
                    @endif
                </h2>
                <table style="width: 100%; text-align: left; border-collapse: collapse;">
                    <thead>
                        <tr style="text-transform: uppercase;">
                            <th style="padding-right: 0.75rem;">date</th>
                            <th style="padding-right: 0.75rem; padding-left: 0.75rem;">item name</th>
                            <th style="padding-right: 0.75rem; padding-left: 0.75rem;">total rented</th>
                            <th style="padding-left: 0.75rem;">total cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reportDetails['inventory'] as $item)
                            <tr>
                                <td style="padding-right: 0.75rem;">{{ \Carbon\Carbon::parse($item['inventory']['created_at'])->format('m-d-Y') }}</td>
                                <td style="padding-right: 0.75rem; padding-left: 0.75rem;">{{ $item['inventory']['item_name'] }}</td>
                                <td style="padding-right: 0.75rem; padding-left: 0.75rem;">{{ $item['quantity_rented'] }}</td>
                                <td style="padding-left: 0.75rem;">{{ number_format(($item['inventory']['price'] * $item['quantity_rented']), 2, '.', ',') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>