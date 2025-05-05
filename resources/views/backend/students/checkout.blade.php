<x-backend.layouts.student-master>
<form>
    <div>
        <div class="checkout-container">
            <div class="row p-3">
                <!-- Left: Checkout Form -->
                <div class="col-md-8 checkout-form pr-4">
                    <h2>Checkout</h2>
                        <h5 class="mt-4" style="color: #101828; font-size:20px; font-weight:600">Payment method</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <h5 style="color: #344054; font-size:14px; font-weight:600">Card details</h5>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label">Name on card</label>
                                        <input type="text" class="form-control" value="" readonly>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Expiry</label>
                                        <input type="text" class="form-control" value="" readonly>
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label">Card number</label>
                                        <input type="text" class="form-control card-number" value="" readonly>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">CVV</label>
                                        <input type="text" class="form-control" value="" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <h5 style="color: #344054; font-size:14px; font-weight:600">Email address</h5>
                            </div>
                            <div class="col-md-8">
                                <div>
                                    <input type="email" class="form-control email-input" value="billing@gmail.com" readonly>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <h5 style="color: #344054; font-size:14px; font-weight:600">Street address</h5>
                            </div>
                            <div class="col-md-8">
                                <div>
                                    <input type="text" class="form-control" value="100 Smith Street" readonly>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <h5 style="color: #344054; font-size:14px; font-weight:600">City</h5>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="Collingwood" readonly>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <h5 style="color: #344054; font-size:14px; font-weight:600">State / Province</h5>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="VIC" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" value="3066" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
    
                <!-- Right: Order Summary -->
                <div class="col-md-4">
                    <h5><b>Order Summary</b></h5>
                    <div class="order-summary">
                        <div class="mb-2">
                            <h5 class="mb-0" style="font-size: 18px; font-weight:600">3 months Plan <span class="badge bg-light text-dark border ms-1" style="border-radius: 8px">Monthly</span></h5>
                            <p class="text-muted">Perfect for starting your journey</p>
                        </div>
                        <div class="input-group mb-3 mt-2">
                            <input type="text" class="form-control" placeholder="Coupon code">
                            <button class="btn ml-2 btn-primary">Apply</button>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total</span>
                            <span style="color:#475569"> $661.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Discount</span>
                            <span style="color:#475569"> $40.00</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong>Order Total (3)</strong>
                            <strong>$701.08</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-4 pt-2" style="border-top: 1px solid #ddd;">
                <button type="button" class="btn mr-2" style="border: 1px solid #691D5E;; background-color:  #691D5E; border-radius: 8px; color:#fff">Submit Order</button>
            </div>
        </div>
    </div>
</form>


    @push('css')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .checkout-container {
            margin: 50px auto;
        }
        .checkout-form h2, .order-summary h5 {
            font-weight: bold;
            color: #333;
        }
        .form-control {
            border-radius: 8px;
            border: 1px solid #ced4da;
            padding: 10px;
            font-size: 14px;
        }
        .form-label {
            font-size: 12px;
            color: #6c757d;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .card-number {
            background: url('https://via.placeholder.com/30x20?text=Card') no-repeat 10px center;
            padding-left: 50px;
        }
        .email-input {
            background: url('https://via.placeholder.com/20x20?text=@') no-repeat 10px center;
            padding-left: 40px;
        }
        .country-select {
            background: url('https://via.placeholder.com/20x20?text=Flag') no-repeat 10px center;
            padding-left: 40px;
        }
        .order-summary {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;
        }
        .order-summary .btn {
            background-color: #691D5E;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 14px;
        }
        .submit-btn {
            background-color: #691D5E;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 14px;
            width: 100%;
        }
        .text-discount {
            color: red;
        }
        .content {
            padding: 0px;
        }
    </style>
    @endpush

</x-backend.layouts.student-master>