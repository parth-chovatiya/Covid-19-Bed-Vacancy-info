<?php 
  session_start();
  include 'partials/_dbconnect.php'; 
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="./css/navbar.css" />
    <link rel="stylesheet" href="./css/home1.css" />
    <link rel="shortcut icon" href="../download.jfif" type="image/x-icon" />

    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    />
    <link rel="stylesheet" href="./css/footer1.css" />
    <title>Home</title>
    <style></style>
  </head>

  <body>
    <?php include 'partials/_navbar.php'; ?>
    <div class="header">
      <div class="img-together">
        <img src="./images/togetherness.png" alt="not visible" />
      </div>
      <div class="headline">
        <h1>Let's Stay Safe & Fight Together Against Corona Virus</h1>
      </div>
    </div>

    <?php
        $data = file_get_contents('https://api.covid19india.org/data.json');
        $coronalive = json_decode($data, true);

        $daycount = count($coronalive['cases_time_series']);
        $dailyconfirmed = $coronalive['cases_time_series'][$daycount-1]['dailyconfirmed'];
        $dailydeaths = $coronalive['cases_time_series'][$daycount-1]['dailydeceased'];
        $dailyrecovered = $coronalive['cases_time_series'][$daycount-1]['dailyrecovered'];

        $date = $coronalive['cases_time_series'][$daycount-1]['date'];

        $total = $coronalive['statewise'][0]['confirmed'];
        $active = $coronalive['statewise'][0]['active'];
        $recovered = $coronalive['statewise'][0]['recovered'];
        $deaths = $coronalive['statewise'][0]['deaths'];

        $testedCount = count($coronalive['tested']);
        $vaccinet = $coronalive['tested'][$testedCount-1]['totaldosesadministered'];
    ?>

    <div class="last-update">
      <h3>
        Last Update <?php echo $date; ?>
      </h3>
    </div>
    <div class="vaccine-update">
      <span>
        <svg
          aria-hidden="true"
          role="img"
          class="octicon octicon-shield-check logo"
          viewBox="0 0 16 16"
          width="16"
          height="16"
          fill="currentColor"
          style="
            display: inline-block;
            user-select: none;
            vertical-align: text-bottom;
          "
        >
          <path
            fill-rule="evenodd"
            d="M8.533.133a1.75 1.75 0 00-1.066 0l-5.25 1.68A1.75 1.75 0 001 3.48V7c0 1.566.32 3.182 1.303 4.682.983 1.498 2.585 2.813 5.032 3.855a1.7 1.7 0 001.33 0c2.447-1.042 4.049-2.357 5.032-3.855C14.68 10.182 15 8.566 15 7V3.48a1.75 1.75 0 00-1.217-1.667L8.533.133zm-.61 1.429a.25.25 0 01.153 0l5.25 1.68a.25.25 0 01.174.238V7c0 1.358-.275 2.666-1.057 3.86-.784 1.194-2.121 2.34-4.366 3.297a.2.2 0 01-.154 0c-2.245-.956-3.582-2.104-4.366-3.298C2.775 9.666 2.5 8.36 2.5 7V3.48a.25.25 0 01.174-.237l5.25-1.68zM11.28 6.28a.75.75 0 00-1.06-1.06L7.25 8.19l-.97-.97a.75.75 0 10-1.06 1.06l1.5 1.5a.75.75 0 001.06 0l3.5-3.5z"
          ></path>
        </svg>
        <?php echo number_format($vaccinet) ?>
        vaccine doses administered
      </span>
    </div>
    <div class="daily">
      <div class="covid-update">
        <div class="inner-detail" id="box-1">
          <i class="fas fa-virus fa-3x icon"></i>
          <div class="total-cases text-right">
            <span class="text-orange font-weight-bold" style="font-size: 35px">
              <?php echo number_format($total); ?>
            </span>
            &nbsp
            <sub class="text-orange font-weight-bold" style="font-size: 17px">
              <i class="fas fa-arrow-up"></i>
              <?php echo number_format($dailyconfirmed); ?>
            </sub>
          </div>
          <p class="text">Total Corona Cases</p>
        </div>

        <div class="inner-detail" id="box-2">
          <i class="fas fa-virus fa-3x icon"></i>
          <div class="active-cases text-right">
            <span
              class="text-redorange font-weight-bold"
              style="font-size: 35px"
            >
              <?php echo number_format($active); ?>
            </span>
          </div>
          <p class="text">Active Cases</p>
        </div>
        <div class="inner-detail" id="box-3">
          <i class="fas fa-virus fa-3x icon"></i>
          <div class="total-recoverd text-right">
            <span class="text-success font-weight-bold" style="font-size: 35px">
              <?php echo number_format($recovered); ?>
            </span>
            &nbsp
            <sub class="text-success font-weight-bold" style="font-size: 17px">
              <i class="fas fa-arrow-up"></i>
              <?php echo number_format($dailyrecovered); ?>
            </sub>
          </div>
          <p class="text">Total Recoverd</p>
        </div>
        <div class="inner-detail" id="box-4">
          <i class="fas fa-virus fa-3x icon"></i>
          <div class="total-deaths text-right">
            <span class="text-red font-weight-bold" style="font-size: 35px">
              <?php echo number_format($deaths); ?>
            </span>
            &nbsp
            <sub class="text-red font-weight-bold" style="font-size: 17px">
              <i class="fas fa-arrow-up"></i>
              <?php echo number_format($dailydeaths); ?>
            </sub>
          </div>
          <p class="text">Total Deaths</p>
        </div>
      </div>
    </div>

    <div class="contribute">
      <p>
        To Contibute in Chief Minister Relief Fund:
        <a href="https://iora.gujarat.gov.in/cmrf/"
          >https://iora.gujarat.gov.in/cmrf/</a
        >
      </p>
    </div>

    <div class="lockdown">
      <marquee
        behavior="scroll"
        direction="left"
        onmouseover="this.stop();"
        onmouseout="this.start();"
      >
        <p>
          Lockdown- To apply to get Exemption Pass to travel outside Gujarat -
          <a href="https://www.digitalgujarat.gov.in/loginapp/CitizenLogin.aspx"><b>Click Here</b></a>
        </p>
      </marquee>
    </div>

    <div class="list">
      <marquee
        behavior="scroll"
        direction="left"
        onmouseover="this.stop();"
        onmouseout="this.start();"
      >
        <p>
          List of Nodal Officers to facilitate movement of Citizens across state
          borders - <a href="https://gad.gujarat.gov.in/personnel/Portal/News/407_1_1_order%2029%20april-GAD6--1.pdf"><b>Click Here</b></a>
        </p>
      </marquee>
    </div>

    <h1 class="tc">About Covid 19</h1>
    <div class="about-covid">
      <div class="img-box">
        <img src="./images/corona.jpg" alt="" />
      </div>
      <div class="content">
        <h1>What is Covid 19?</h1>
        <p>
          Coronaviruses are a large family of viruses that cause illness ranging
          from the common cold to more severe diseases such as Middle East
          Respiratory Syndrome and Severe Acute Respiratory Syndrome. 2019-nCoV
          is a new strain that has not been previously identified in humans and
          causes COVID19/coronavirus disease.
        </p>
        <p>
          COVID-19 is caused by infection with the severe acute respiratory
          syndrome coronavirus 2 (SARS-CoV-2) virus strain.
        </p>
        <!-- <p>COVID-19 is caused by infection with the severe acute respiratory syndrome coronavirus 2 (SARS-CoV-2) virus strain.</p> -->
      </div>
    </div>
    <h1 class="tc">Coronavirus symptoms</h1>
    <div class="covid-symptoms">
      <div class="cough">
        <img id="fixed-img" src="./images/cough.jpg" alt="" />
        <p class="capitalize">cough</p>
      </div>
      <div class="runny-nose">
        <img id="fixed-img" src="./images/runny-nose.png" alt="" />
        <p class="capitalize">runny noise</p>
      </div>
      <div class="fever">
        <img id="fixed-img" src="./images/fever.jpg" alt="" />
        <p class="capitalize">fever</p>
      </div>
    </div>
    <div class="covid-symptoms">
      <div class="cold">
        <img id="fixed-img" src="./images/cold.jpg" alt="" />
        <p class="capitalize">cold</p>
      </div>
      <div class="tiredness">
        <img id="fixed-img" src="./images/tiredness.jpg" alt="" />
        <p class="capitalize">tiredness</p>
      </div>
      <div class="breathing">
        <img id="fixed-img" src="./images/breathing.jpg" alt="" />
        <p class="capitalize">difficutly breathing</p>
      </div>
    </div>

    <h1 class="tc">Steps Prevention Against Coronavirus</h1>

    <div class="aginst-covid">
      <div class="wash-hand fixed">
        <img src="./images/wash-hand.jpg" alt="" />
        <p class="capitalize">Wash your hands regularly for 20-30 seconds with soap and water</p>
      </div>
      <div class="wear-mask fixed">
        <img src="./images/wear-mask.jpg" alt="" />
        <p class="capitalize">
          Cover your nose and mouth with a disposable tissue or fiexed elbow
          when you cough or sneeze
        </p>
      </div>
    </div>
    <div class="aginst-covid">
      <div class="make-distance fixed">
        <img src="./images/make-distance.jpg" alt="" />
        <p class="capitalize">
          Avoid close contact with people who is unwell. Make distance of 2
          meter.
        </p>
      </div>
      <div class="news fixed">
        <img src="./images/news.jpg" alt="" />
        <p class="capitalize">Stay informed by watching news.</p>
      </div>
    </div>

    <h3 class="tc">Awareness About COVID-19</h3>
    <section class="awareness">
        <div>
            <div class="row-poster">
                <div class="poster">
                    <img src="./awareness/socialdistancingEnglish-1.jpg" alt="Poster on Social distancing in a market place during COVID-19 English">
                </div>
                <div class="poster">
                    <img src="./awareness/FINAL_14_03_2020_ENg-1.jpg" alt="When to get tested for COVID-19 English">
                </div>
                <div class="poster">
                    <img src="./awareness/ProtectivemeasuresEng-1.jpg">
                </div>
            </div>
            <div class="row-poster">
                <div class="poster">
                    <img src="./awareness/PostrerEnglishtraveller-1.jpg" alt="Posters for Indians traveling from abroad - English">
                </div>
                <div class="poster">
                  <img src="./awareness/Poster_Corona_ad_Eng-1.jpg" alt="Do's and Don't Poster in English">
                </div>
                <div class="poster myphoto">
                    <img class="" src="./awareness/3cs.png" alt="Do's and Don't Poster in English">
                </div>
              </div>
        </div>
    </section>

    <h3 class="tc">FAQs About COVID-19</h3>
    <section class="pdf">
        <div class="faq-content">
            <embed src="./awareness/FAQ.pdf" type="application/pdf" width="70%" height="700px"/>
            <!-- <a class="btn-faq mob-show" href="./FAQ.pdf " target="_blank">Click to see the FAQ pdf</a> -->
        </div>
    </section>
    <div class="extra"></div>
    <?php include 'partials/_footer1.php';   ?>
    <script src="./vendor/dark-light-mode.js"></script>
  </body>
</html>
