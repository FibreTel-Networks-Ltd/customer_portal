<script nonce="{{ csp_nonce() }}">
    close=document.getElementById("close");close.addEventListener('click',function(){close.classList.add("csp_style3"); setTimeout(function(){ close.classList.add("csp_style1"); }, 600); },false);
   var _portal = {
       currencySymbol: '{{config("customer_portal.currency_symbol")}}',
       thousandsSeparator: '{{config("customer_portal.thousands_separator")}}',
       decimalSeparator: '{{config("customer_portal.decimal_separator")}}'
   };
</script>
<script src="/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="/assets/lang.dist.js"></script>
<script src="/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/libs/chart.js/dist/Chart.min.js"></script>
<script src="/assets/libs/highlight/highlight.min.js"></script>
<script src="/assets/libs/flatpickr/dist/flatpickr.min.js"></script>
<script src="/assets/libs/list.js/dist/list.min.js"></script>
<script src="/assets/libs/select2/select2.min.js"></script>
<script src="/assets/libs/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
<script src="/assets/libs/jquery-payment-plugin/jquery.payment.min.js"></script>
<script src="/assets/libs/moment/moment.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script nonce="{{ csp_nonce() }}">
    moment.locale('{{config("app.locale")}}');
   $(document).ready(function(){
   $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});$(".languageSelector").change(function(){var language = $(this).val();$.ajax("/language",{data: {language: language},dataType: 'json',type: 'POST'}).then(function() {setTimeout(function(){location.reload();}, 100);});});});
   Number.prototype.formatCurrency = function(c){
       var n = this,
           c = isNaN(c = Math.abs(c)) ? 2 : c,
           d = _portal.decimalSeparator,
           t = _portal.thousandsSeparator,
           s = n < 0 ? "-" : "",
           i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
           j = (j = i.length) > 3 ? j % 3 : 0;
       return _portal.currencySymbol + s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
   };
</script>
<script nonce="{{ csp_nonce() }}">
    $(document).ready(function() {
        $('.btn-disable-with-msg-on-click').each(function(idx, button) {
            $(button).on('click', function() {
                $(this.form).submit();
                var $button = $(this);
                $button.html('<i class="fe fe-loader mt-2 mr-2"> ' + $button.data('message') + '</i>');
                $button.prop('disabled', true);
            });
        });
    });
</script>
@yield('additionalJS')


<script nonce="{{ csp_nonce() }}">
    document.addEventListener('DOMContentLoaded', function () {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

        // Generic copy behavior for elements with the "data-copy" attribute
        const copyIcons = document.querySelectorAll('[data-copy]');
        copyIcons.forEach(icon => {
            icon.addEventListener('click', function () {
                const textToCopy = this.getAttribute('data-copy');
                navigator.clipboard.writeText(textToCopy).then(() => {
                    // Dynamically create and style the feedback element
                    const feedback = document.createElement('div');
                    feedback.innerText = '{{ __('messages.copiedToClipboard') }}';
                    feedback.style.backgroundColor = 'var(--success-color)';
                    feedback.style.color = '#fff';
                    feedback.style.padding = '5px 5px';
                    feedback.style.borderRadius = '4px';
                    feedback.style.fontSize = '0.8rem';
                    feedback.style.position = 'absolute';
                    feedback.style.minWidth = '150px';
                    feedback.style.whiteSpace = 'nowrap';
                    feedback.style.zIndex = '1000';
                    // Position feedback next to the icon
                    feedback.style.top = (this.offsetTop) + 'px';
                    feedback.style.left = (this.offsetLeft + this.offsetWidth + 10) + 'px';
                    feedback.style.opacity = '1';
                    feedback.style.transition = 'opacity 0.5s ease';

                    this.parentNode.appendChild(feedback);

                    // Fade out and remove the feedback element
                    setTimeout(() => {
                        feedback.style.opacity = '0';
                        setTimeout(() => {
                            feedback.remove();
                        }, 500);
                    }, 1500);
                });
            });
        });
    });
</script>
