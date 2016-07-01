

<!--        <script src="http://code.jquery.com/jquery-1.9.0.js"></script>-->



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