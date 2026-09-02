<!-- Product Inquiry Modal -->
<div class="modal fade audio_modal"
    id="productInquiryModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="productInquiryModalLabel"
    aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="audio-card d-grid">
                    <div class="modal-header px-0 border-0">
                        <h4 class="title_40 mb-0"
                            id="productInquiryModalLabel">
                            Product Inquiry
                        </h4>
                        <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                        </button>
                    </div>

                    <form method="POST"
                        action="{{ route('front.store.festival.product.inquiry') }}"
                        id="productInquiryForm"
                        class="ct_form">

                        @csrf

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Name</label>
                                    <input type="text"
                                        name="name"
                                        placeholder="Enter your Name"
                                        value="{{ old('name') }}"
                                        required
                                        oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">
                                        Inquire For Product
                                    </label>
                                    <input type="text"
                                        id="productInquiryProductName"
                                        name="product_name"
                                        value=""
                                        readonly
                                        required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">Email</label>
                                    <input type="email"
                                        name="email"
                                        placeholder="Enter your Email Address"
                                        value="{{ old('email') }}"
                                        required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="ct_input">
                                    <label class="sub_head">
                                        Contact Number
                                    </label>
                                    <input type="text"
                                        name="contact_no"
                                        placeholder="Enter your Contact Number"
                                        value="{{ old('contact_no') }}"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="ct_input">
                                    <label class="sub_head">Message</label>
                                    <textarea
                                        name="message"
                                        placeholder="Enter your Message"
                                        rows="2">{{ old('message') }}</textarea>
                                </div>
                            </div>

                            <div class="col-lg-12 text-center">
                                <button type="button"
                                    class="com_btn bg-transparent"
                                    data-bs-dismiss="modal">
                                    Close
                                </button>
                                <button type="submit"
                                    class="com_btn bg-transparent ms-2">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>