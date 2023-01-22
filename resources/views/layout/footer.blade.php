<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="{{ url('/ubold/assets/js/jquery.min.js') }}"></script>
<script src="{{ url('/ubold/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ url('/ubold/assets/js/detect.js') }}"></script>
<script src="{{ url('/ubold/assets/js/fastclick.js') }}"></script>
<script src="{{ url('/ubold/assets/js/jquery.slimscroll.js') }}"></script>
<script src="{{ url('/ubold/assets/js/jquery.blockUI.js') }}"></script>
<script src="{{ url('/ubold/assets/js/waves.js') }}"></script>
<script src="{{ url('/ubold/assets/js/wow.min.js') }}"></script>
<script src="{{ url('/ubold/assets/js/jquery.nicescroll.js') }}"></script>
<script src="{{ url('/ubold/assets/js/jquery.scrollTo.min.js') }}"></script>

@yield('add-footer')

<script src="{{ url('/ubold/assets/js/jquery.core.js') }}"></script>
<script src="{{ url('/ubold/assets/js/jquery.app.js') }}"></script>

@yield('add-chart-footer')

<script src="{{ url('/ubold/assets/plugins/custombox/js/custombox.min.js') }}"></script>
<script src="{{ url('/ubold/assets/plugins/custombox/js/legacy.min.js') }}"></script>

<script src="{{ url('/ubold/assets/plugins/ladda-buttons/js/spin.min.js') }}"></script>
<script src="{{ url('/ubold/assets/plugins/ladda-buttons/js/ladda.min.js') }}"></script>
<script src="{{ url('/ubold/assets/plugins/ladda-buttons/js/ladda.jquery.min.js') }}"></script>

<script src="{{ url('/ubold/assets/plugins/notifyjs/js/notify.js') }}"></script>
<script src="{{ url('/ubold/assets/plugins/notifications/notify-metro.js') }}"></script>

<script>
    $(document).ready(function() {

        // Bind normal buttons
        $('.ladda-button').ladda('bind', {
            timeout: 2000
        });

        // Bind progress buttons and simulate loading progress
        Ladda.bind('.progress-demo .ladda-button', {
            callback: function(instance) {
                var progress = 0;
                var interval = setInterval(function() {
                    progress = Math.min(progress + Math.random() * 0.1, 1);
                    instance.setProgress(progress);

                    if (progress === 1) {
                        instance.stop();
                        clearInterval(interval);
                    }
                }, 200);
            }
        });


        var l = $('.ladda-button-demo').ladda();

        l.click(function() {
            // Start loading
            l.ladda('start');

            // Timeout example
            // Do something in backend and then stop ladda
            setTimeout(function() {
                l.ladda('stop');
            }, 12000)
        });

        let notif = "{{ Session::get('sukses') }}";
        let notif3 = "{{ Session::get('error') }}";
        if (notif) {
            $.Notification.autoHideNotify('success', 'top right', 'Berhasil...!!',
                notif
            )
        } else if (notif3) {
            $.Notification.autoHideNotify('error', 'top right', 'Gagal...!!',
                notif
            )
        }

    });
</script>
