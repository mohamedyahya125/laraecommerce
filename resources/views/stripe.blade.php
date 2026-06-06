@extends('maindesing')

<base href="/public/">

@section('script_view')
    <style>
        /* التنسيقات العامة لصفحة الدفع */
        .checkout-section {
            padding: 60px 0;
            background-color: #f8fafc;
            font-family: 'Poppins', 'Segoe UI', sans-serif;
            min-height: 80vh;
            display: flex;
            align-items: center;
        }

        .checkout-title {
            font-size: 1.8rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 30px;
            letter-spacing: -0.5px;
        }

        /* كرت صندوق الدفع العصري */
        .credit-card-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            overflow: hidden;
            max-width: 550px;
            margin: 0 auto;
        }

        .card-header-custom {
            background-color: #ffffff;
            border-bottom: 1px solid #f1f5f9;
            padding: 25px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header-custom h3 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #0f172a;
            margin: 0;
        }

        /* أيقونات البطاقات */
        .payment-icons {
            display: flex;
            gap: 8px;
            font-size: 1.4rem;
            color: #94a3b8;
        }

        .card-body-custom {
            padding: 30px;
        }

        /* تنسيق الحقول والمسميات */
        .form-label-custom {
            font-size: 0.85rem;
            font-weight: 600;
            color: #475569;
            margin-bottom: 8px;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* حاويات حقول Stripe المستقلة */
        .form-control-custom {
            width: 100%;
            padding: 12px 16px;
            font-size: 0.95rem;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            background-color: #ffffff;
            color: #1e293b;
            transition: all 0.2s ease;
            min-height: 45px;
            /* لضمان ثبات الارتفاع مع حقول Stripe */
        }

        /* تأثير الـ Focus عند الضغط داخل حقل Stripe */
        .stripe-field-focus {
            border-color: #635bff !important;
            box-shadow: 0 0 0 4px rgba(99, 91, 255, 0.1) !important;
            outline: none;
        }

        /* الحقول المتجاورة (العرض الأفقي) */
        .form-flex-row {
            display: flex;
            gap: 15px;
        }

        .form-flex-col {
            flex: 1;
        }

        .form-group-custom {
            margin-bottom: 20px;
        }

        /* زر اتمام الدفع عبر Stripe */
        .btn-submit-payment {
            width: 100%;
            background: linear-gradient(135deg, #635bff, #4338ca);
            color: #ffffff;
            font-weight: 700;
            font-size: 1.05rem;
            padding: 14px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 15px rgba(99, 91, 255, 0.2);
            margin-top: 10px;
        }

        .btn-submit-payment:hover {
            background: linear-gradient(135deg, #4338ca, #312e81);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(99, 91, 255, 0.3);
        }

        /* التنبيهات والأخطاء */
        .alert-custom-success {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
            border-radius: 12px;
            padding: 15px;
            margin-bottom: 25px;
            font-weight: 500;
        }

        #card-errors {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 8px;
            font-weight: 500;
        }
    </style>

    <div class="checkout-section">
        <div class="container">

            <div class="text-center">
                <h1 class="checkout-title">Secure Stripe Checkout</h1>
            </div>

            <div class="credit-card-box">
                <div class="card-header-custom">
                    <h3>Payment Details</h3>
                    <div class="payment-icons">
                        <span>💳</span>
                        <span style="font-size: 0.85rem; font-weight: 600; color: #635bff;">Stripe Secured</span>
                    </div>
                </div>

                <div class="card-body-custom">

                    @if (Session::has('success'))
                        <div class="alert-custom-success text-center">
                            <p class="mb-0">✨ {{ Session::get('success') }}</p>
                        </div>
                    @endif

                    <form role="form" action="{{ route('stripe.post') }}" method="post" id="payment-form"
                        data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
                        @csrf

                        <div class="form-group-custom">
                            <label class="form-label-custom">Name on Card</label>
                            <input class="form-control-custom" type="text" id="card-holder-name" placeholder="John Doe"
                                required>
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom">Address</label>
                            <input class="form-control-custom" type="text" name="receiver_address"
                                placeholder="123 Street, City" required>
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom">Phone Number</label>
                            <input class="form-control-custom" type="text" name="receiver_phone"
                                placeholder="+20 123 456 789" required>
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom">Card Number</label>
                            <div id="stripe-card-number" class="form-control-custom"></div>
                        </div>

                        <div class="form-flex-row">
                            <div class="form-flex-col form-group-custom">
                                <label class="form-label-custom">CVC</label>
                                <div id="stripe-card-cvc" class="form-control-custom"></div>
                            </div>

                            <div class="form-flex-col form-group-custom">
                                <label class="form-label-custom">Expiration Date</label>
                                <div id="stripe-card-expiry" class="form-control-custom"></div>
                            </div>
                        </div>

                        <div id="card-errors" role="alert"></div>

                        <div class="text-center">
                            <button class="btn-submit-payment" id="submit-button" type="submit">
                                🔒 Pay Now (${{ number_format($price, 2) }})
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

<script src="https://js.stripe.com/v3/"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
    $(function() {
        var $form = $('#payment-form');
        var publishableKey = $form.data('stripe-publishable-key');

        if (!publishableKey) {
            console.error('Stripe publishable key is missing!');
            return;
        }

        // تهيئة Stripe v3
        var stripe = Stripe(publishableKey);
        var elements = stripe.elements();

        // التنسيقات الخاصة بداخل حقول إدخال Stripe لتطابق مشروعك
        var style = {
            base: {
                color: '#1e293b',
                fontFamily: '"Poppins", "Segoe UI", sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '15px',
                '::placeholder': {
                    color: '#94a3b8'
                }
            },
            invalid: {
                color: '#dc2626',
                iconColor: '#dc2626'
            }
        };

        // 1. إنشاء حقل رقم البطاقة منفصل
        var cardNumber = elements.create('cardNumber', {
            style: style
        });
        cardNumber.mount('#stripe-card-number');

        // 2. إنشاء حقل الـ CVC منفصل
        var cardCvc = elements.create('cardCvc', {
            style: style
        });
        cardCvc.mount('#stripe-card-cvc');

        // 3. إنشاء حقل تاريخ الانتهاء الموحد (MM/YY) ليعطي أفضل تجربة للمستخدم
        var cardExpiry = elements.create('cardExpiry', {
            style: style
        });
        cardExpiry.mount('#stripe-card-expiry');

        // إضافة تأثيرات التركيز (Focus / Blur) للحقول الثلاثة ديناميكياً
        var fields = [cardNumber, cardCvc, cardExpiry];
        fields.forEach(function(field) {
            field.on('focus', function(e) {
                $(field._mountElement).addClass('stripe-field-focus');
            });
            field.on('blur', function(e) {
                $(field._mountElement).removeClass('stripe-field-focus');
            });

            // مراقبة الأخطاء أثناء الكتابة
            field.on('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });
        });

        // معالجة إرسال الفورم وتوليد التوكن
        $form.on('submit', function(e) {
            e.preventDefault();

            // تعطيل زر الدفع مؤقتاً لمنع التكرار
            $('#submit-button').prop('disabled', true).text('Processing Payment...');

            var options = {
                name: $('#card-holder-name').val()
            };

            // نمرر حقل cardNumber فقط وهو يقوم تلقائياً بجمع الـ CVC والتاريخ برمجياً لإنشاء التوكن
            stripe.createToken(cardNumber, options).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                    $('#submit-button').prop('disabled', false).html(
                        '🔒 Pay Now (${{ number_format($price, 2) }})');
                } else {
                    // إرسال التوكن بنجاح للـ Controller الخاص بك
                    var token = result.token.id;
                    $form.append("<input type='hidden' name='stripeToken' value='" + token +
                        "'/>");
                    $form.get(0).submit();
                }
            });
        });
    });
</script>
