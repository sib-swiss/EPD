<?php include("header.php"); ?>

<!-- News statement at the top of the page -->
<div class="news" style="border-style:solid; border-width:1px; border-color:darkgrey; padding:5px">
<table style="width:100%">
<tr>
<td style="font-size:14px; vertical-align:text-top" colspan="2">
   <a href="/miniepd/news.php">See all news</a>
</td>
</tr>
<?php
    echo file_get_contents("http://localhost:8081/miniepd/lastnews.php?query=EPD");
?>
</table>
</div>


<br><br>
<h1>EPD privacy notice</h1>

<div class="card__container"><div class="card__content"><div><p>This Privacy Notice explains what personal data is collected by the specific service you are requesting, for what purposes, how it is processed, and how we keep it secure.</p>
<h2 id="1-who-controls-your-personal-data-and-how-to-contact-us">1. Who controls your personal data and how to contact us?</h2>
<p>The EPD data controller's contact details are:<br>Philipp Bucher, EPD Principal Investigator<br>Email: ask-epd <em>[at]</em> googlegroups.com</p>

<h2 id="2-which-is-the-lawful-basis-for-processing-personal-data">2. Which is the lawful basis for processing personal data?</h2>
<p>Processing your personal data is necessary for our legitimate interests in providing services to you, to help improve our resources, and for the purposes of day-to-day running of the EPD resource and underlying infrastructure.</p>
<h2 id="3-what-personal-data-is-collected-from-users-of-the-service-how-do-we-use-this-personal-data">3. What personal data is collected from users of the service? How do we use this personal data?</h2>
<p>The personal data collected from the services listed below is as follows:</p>
<h3 id="website-and-api">Website and API</h3>
<ul>
<li>IP address</li>
<li>Date and time of a visit to the service</li>
<li>Operating system</li>
<li>Browser</li>
<li>Device</li>
<li>Amount of data transmitted</li>
</ul>
<p>The data controller will use your personal data for the following purposes:</p>
<ul>
<li>To provide the user access to the service</li>
<li>To better understand the needs of the users and guide future improvements of the service</li>
<li>To create anonymous usage statistics</li>
<li>To conduct and monitor data protection activities</li>
<li>To conduct and monitor security activities</li>
</ul>
<h2 id="4-who-will-have-access-to-your-personal-data">4. Who will have access to your personal data?</h2>
<p>Personal data will only be disclosed to authorized EPD staff.</p>

<h2 id="5-will-your-personal-data-be-transferred-to-third-countries-ie-countries-not-part-of-eueaa-andor-international-organisations">5. Will your personal data be transferred to third countries (i.e. countries not part of EU/EAA) and/or international organisations?</h2>
<p>There are no personal data transfers to international organisations outside EPD.</p>
<p>EPD does not use any web analytics tools.</p>

<h2 id="6-how-long-do-we-keep-your-personal-data">6. How long do we keep your personal data?</h2>
<p>Any personal data directly obtained from you will be retained as long as the service is live, even if you stop using the service. We will keep the personal data for the minimum amount of time possible to ensure legal compliance and to facilitate internal and external audits if they arise.</p>
<h2 id="7-the-joint-data-controllers-provide-these-rights-regarding-your-personal-data">7. The Data Controller provides these rights regarding your personal data</h2>
<p>You have the right to:</p>
<ol>
<li>Not be subject to decisions based solely on an automated processing of data (i.e. without human intervention) without you having your views taken into consideration.</li>
<li>Request at reasonable intervals and without excessive delay or expense, information about the personal data processed about you. Under your request, we will inform you in writing about, for example, the origin of the personal data or the preservation period.</li>
<li>Request information to understand data processing activities when the results of these activities are applied to you.</li>
<li>Object at any time to the processing of your personal data unless we can demonstrate that we have legitimate reasons to process your personal data.</li>
<li>Request free of charge and without excessive delay rectification or erasure of your personal data if we have not been processing it respecting the data protection policies of the respective controllers.</li>
</ol>
<p>Requests and objections can be sent to <code>ask-epd <em>[at]</em> googlegroups.com</code></p>
<p>It must be clarified that rights 4 and 5 are only available whenever the processing of your personal data is not necessary to:</p>
<ul>
<li>Comply with a legal obligation.</li>
<li>Perform a task carried out in the public interest.</li>
<li>Exercise authority as a data controller.</li>
<li>Archive for purposes in the public interest, or for historical research purposes, or for statistical purposes.</li>
<li>Establish, exercise or defend legal claims.</li>
</ul>
</div></div></div>

<!-- ######### Insert the footer #########-->
<?php readfile("footer.html"); ?>

</body>
</html>
