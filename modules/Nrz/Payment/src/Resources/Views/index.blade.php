@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{ route('payments.index') }}" title="تراکنش ها">تراکنش ها</a></li>
@endsection
@section('content')
    <div class="row no-gutters  margin-bottom-10">
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p>کل فروش ۳۰ روز گذشته سایت </p>
            <p>{{ number_format($totalSellIn30Days)  }} تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p>درامد خالص ۳۰ روز گذشته سایت</p>
            <p>{{ number_format($totalSellSiteIn30Days) }} تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-left-10 margin-bottom-10">
            <p>کل فروش سایت</p>
            <p>{{ number_format($totalSell)  }} تومان</p>
        </div>
        <div class="col-3 padding-20 border-radius-3 bg-white margin-bottom-10">
            <p> کل درآمد خالص سایت</p>
            <p>{{number_format($totalSiteSell)}} تومان</p>
        </div>
    </div>
    <div class="row no-gutters border-radius-3 font-size-13">
        <div class="col-12 bg-white padding-30 margin-bottom-20">
            محل نمودار درامد سی روز گذاشته
            <figure class="highcharts-figure">
                <div id="container"></div>
                <p class="highcharts-description">

                </p>
            </figure>

        </div>

    </div>
    <div class="d-flex flex-space-between item-center flex-wrap padding-30 border-radius-3 bg-white">
        <p class="margin-bottom-15">همه تراکنش ها</p>
        <div class="t-header-search">
            <form action="">
                <div class="t-header-searchbox font-size-13">
                    <input type="text" class="text search-input__box font-size-13" placeholder="جستجوی تراکنش">
                    <div class="t-header-search-content ">
                        <input type="text"  class="text" name="email" value="{{ request("email") }}"  placeholder="ایمیل">
                        <input type="text"  class="text" name="amount"  value="{{ request("amount") }}" placeholder="مبلغ به تومان">
                        <input type="text"  class="text" name="invoice_id" value="{{ request("invoice_id") }}" placeholder="شماره">
                        <input type="text"  class="text" name="start_date" value="{{ request("start_date") }}" placeholder="از تاریخ : 1399/10/11">
                        <input type="text" class="text margin-bottom-20" name="end_date" value="{{ request("end_date") }}"  placeholder="تا تاریخ : 1399/10/12">
                        <button type="submit" class="btn btn-webamooz_net" >جستجو</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="table__box">
        <table width="100%" class="table">
            <thead role="rowgroup">
            <tr role="row" class="title-row">
                <th>شناسه پرداخت</th>
                <th>شماره تراکنش</th>
                <th>نام و نام خانوادگی</th>
                <th>ایمیل پرداخت کننده</th>
                <th>مبلغ (تومان)</th>
                <th>درامد مدرس</th>
                <th>درامد سایت</th>
                <th>نام دوره</th>
                <th>تاریخ و ساعت</th>
                <th>وضعیت</th>

            </tr>
            </thead>
            <tbody>
            @foreach($payments as $payment)
                <tr role="row">
                    <td><a href=""> {{$payment->id}}</a></td>
                    <td><a href=""> {{$payment->invoice_id}}</a></td>
                    <td><a href="">{{$payment->buyer->name}}</a></td>
                    <td><a href="">{{$payment->buyer->email}}</a></td>
                    <td><a href="">{{$payment->amount}}</a></td>
                    <td><a href="">{{$payment->seller_share}}</a></td>
                    <td><a href="">{{$payment->site_share}}</a></td>
                    <td><a href="">{{$payment->paymentable->title}}</a></td>
                    <td><a href="">{{jdate($payment->created_at)}}</a></td>
                    <td>
                        <a class="@if($payment->status== \Nrz\Payment\Models\Payment::STATUS_SUCCESS) text-success @else text-error @endif"> @lang($payment->status)</a>
                    </td>


                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('css')
    <style>
        .highcharts-figure, .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #EBEBEB;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

    </style>
@endsection
@section('js')
    <script>
        @include('Common::layout.feedback')
    </script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <script>
        Highcharts.chart('container', {
            title: {
                text: 'تراکنش های  30 روز گذشته'
            },
            xAxis: {
                categories: [@foreach($past30Days as $day) '{{jdate($day)->format('Y-m-d')}}',  @endforeach]
            },
            legend: {
                rtl: true
            },
            tooltip: {
                useHTML: true,
                style: {
                    fontSize: '20px',
                    fontFamily: 'tahoma',
                    direction: 'rtl',
                },
                formatter: function () {
                    return (this.x ? "تاریخ: " +  this.x + "<br>" : "")  + "مبلغ: " + this.y
                }
            },
            yAxis:{
                title: {
                    text: "مبلغ"
                },
                labels: {
                    formatter: function () {
                        return this.value + " تومان"
                    }
                }
            },
            labels: {
                items: [{
                    html: 'تراکنش های  30 روز گذشته',
                    style: {
                        left: '50px',
                        top: '18px',
                        color: ( // theme
                            Highcharts.defaultOptions.title.style &&
                            Highcharts.defaultOptions.title.style.color
                        ) || 'black'
                    }
                }]
            },
            series: [
                {
                    type: 'column',
                    name: 'درصد سایت',
                    color: "green" ,
                    data: [@foreach($past30Days as $day ) {{$paymentRepo->siteShareInDay($day)}}, @endforeach]
                },
                {
                    type: 'column',
                    name: 'تراکنش موفق',
                    data: [@foreach($past30Days as $day ) {{$paymentRepo->SellSuccessInDay($day)}}, @endforeach]
                },

                {
                    type: 'column',
                    name: 'درصد مدرس',
                    color: "pink",
                    data: [@foreach($past30Days as $day ) {{$paymentRepo->sellerShareInDay($day)}}, @endforeach]
                },


                {
                    type: 'spline',
                    name: 'تراکنش موفق',
                    data: [@foreach($past30Days as $day ) {{$paymentRepo->SellSuccessInDay($day)}}, @endforeach],
                    marker: {
                        lineWidth: 2,
                        lineColor: "green",
                        fillColor: 'white'
                    },
                    color:"green"

                }, {
                    type: 'pie',
                    name: 'درصد سایت و مدرس',
                    data: [
                        {
                        name: 'درصد سایت',
                        y: {{$totalSiteSell}},
                        color: "green"// Jane's color
                    },
                        {
                        name: 'درصد مدرس',
                        y: {{$totalSell-$totalSiteSell}},
                        color: "pink" // John's color
                    },

                    ],
                    center: [100, 80],
                    size: 100,
                    showInLegend: false,
                    dataLabels: {
                        enabled: false
                    }
                }]
        });


    </script>
@endsection
