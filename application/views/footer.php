
        <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!--        <script src="http://code.jquery.com/jquery-1.9.0.js"></script>-->
        <script src="../../public/js/jquery-ui.min.js"></script>
        <script src="../../public/js/common.js?v=1.1"></script>
        <script src="../../public/js/jquery.color-2.1.2.min.js"></script>


        <script>
            $(function() {
                $( "#datepicker_start" ).datepicker({
                    numberOfMonths: 2,
                    showButtonPanel: true,
                    showOn: "button",
                    buttonImage: "../../public/img/calendar.gif",
                    buttonImageOnly: true,
                    buttonText: "Select date",
                    dateFormat: "yy-mm-dd",
                    minDate: -20
                });

                $( "#datepicker_period" ).datepicker({
                    numberOfMonths: 4,
                    showButtonPanel: true,
                    showOn: "button",
                    buttonImage: "../../public/img/calendar.gif",
                    buttonImageOnly: true,
                    buttonText: "Select date",
                    dateFormat: "yy-mm-dd",
                    minDate: -20
                });

            });
        </script>

    </body>
</html>