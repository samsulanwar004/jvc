<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
       <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; || Jogjakarta V-ixion Community 2016 || Support By <a href="https://www.facebook.com/sam.rock41" target="_blank">Sam Rock</a></p>
                </div>
            </div>
        </footer>

    </div>
    <!-- /.container -->

    
    <!-- jQuery -->
    <script src="<?php echo base_url().'assets/js/jquery.js' ?>"></script>
    <script src="<?php echo base_url().'assets/js/custom.js' ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url().'assets/js/bootstrap.min.js' ?>"></script>
    <!-- Event Calender -->
    <script src="<?php echo base_url().'assets/js/jquery.eventCalendar.js' ?>"></script>

    <!-- Script to Activate the Carousel -->
    <script>
        $('.carousel').carousel({
            interval: 5000 //changes the speed
        })

        $(function () {
            //Kalender
            $("#eventCalendarHumanDate").eventCalendar({
                eventsjson: "<?php echo base_url().'api/jadwal/'; ?>",
                jsonDateFormat: "human"  // 'YYYY-MM-DD HH:MM:SS'
            });
        });
    </script>

</body>

</html>