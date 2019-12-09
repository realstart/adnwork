@extends('layouts.main')

@section('style')    
    <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet">
@endsection

@section('content')

<section id="main" class="clearfix contact-us">
    <div class="container">
        <div class="row">
            <div class="col-md-12 m-t-60">
                <h2 class="home_title text-center">Avoid scam & Safty tips</h2>
                <p>
                    AdnList continues to work hard to protect it's users from scammers and being scammed by fake posts.We keep on update tips to AdnList users to recognize fake mails or posts from scamers.
                    Check these following tabs constantly for different past interernet scenarios about classified scames,email scams and how to avoid money laundering.
                </p>
            </div>
            <div class="col-md-12">
                <div class="contactus m-t-20">
                    <div class="" style="min-height:45px;">
                        <ul class="list-style-none">
                            <li>
                                <button class="btn_nav_item btn_safty_tips border_bottom_2">Safty Tips</button>
                            </li>
                            <li>
                                <button class="btn_nav_item btn_email_scams">Email Scams</button>
                            </li>
                            <li>
                                <button class="btn_nav_item btn_phone_scam">Phone Scams</button>
                            </li>
                            <li>
                                <button class="btn_nav_item btn_other_resources">Other resources</button>
                            </li>
                            <li>
                                <button class="btn_nav_item btn_report">Report</button>
                            </li>                        
                        </ul>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="avoid_item safty_tips" >
                        <ol>
                            <li>
                                <p>AdnList is a dedicated platform for local users. So deal locally and respond to local posts.</p>
                            </li>
                            <li>
                                <p>Never share your financial information including credit/debit card, banking numbers or online account credentials to anyone.</p>
                            </li>
                            <li>
                                <p>Avoid any kind of online payment transactions including Westren Union, Money Gram and other payment transaction method. Avoid checks.</p>
                            </li>
                            <li>
                                <p>Never do international transactions for any kind of offers or buying/selling. AdnList operates locally and for local people.</p>
                            </li>
                            <li>
                                <p>Avoid buying gift cards and sending card numbers over phone or email. They are scammers.</p>
                            </li>
                            <li>
                                <p>Avoid shipments in buying/ selling. Always meet locally for trusted transactions.</p>
                            </li>
                            <li>
                                <p>Avoid meeting in annoying places. Always meet in public places (café, shopping centers or busy public places) and choose right day times for buying / selling.</p>
                            </li>
                            <li>
                                <p>Never invite unknown people into house. Always meet outside.</p>
                            </li>
                            <li>
                                <p>Avoid mediator/third party payments.</p>
                            </li>
                            <li>
                                <p>Never share any personal sensitive information (social security, driving license and passport) with anyone.</p>
                            </li>
                            <li>
                                <p>Avoid people contacting that is not local to your area.</p>
                            </li>
                            <li>
                                <p>Avoid deals with people who are unable or refuse to meet face to face.</p>
                            </li>
                        </ol> 
                        <div>
                            <label for="" style="text-decoration:underline;">Note:</label>
                            <ul>
                                <li class="list_none arrow_added"><p>AdnList is an advertising platform that presents user posted content to the public.</p></li>
                                <li class="list_none arrow_added"><p>AdnList never contact you for buying/selling any products.</p></li>
                                <li class="list_none arrow_added"><p>AdnList never contact you for your financial information over phone/ email.</p></li>
                                <li class="list_none arrow_added"><p>AdnList is not a financial adviser, recruiter, real estate broker, legal/tax adviser or investment broker.</p></li>
                            </ul>
                        </div>                    
                    </div>  
                    
                    <div class="avoid_item other_resources" style="display:none;">
                        <p>We are sharing here some important internet resources. Check out these links for recent scams and reports.</p>
                        <br>
                        <ul>
                            <li class="list_none">
                                <p><a target="_blank" href="https://www.consumer.ftc.gov/features/scam-alerts">https://www.consumer.ftc.gov/features/scam-alerts</a></p>
                            </li>
                            <li class="list_none">
                                <p><a target="_blank" href="https://www.usa.gov/common-scams-frauds">https://www.usa.gov/common-scams-frauds</a></p>
                            </li>
                            <li class="list_none">
                                <p><a target="_blank" href="https://www.usa.gov/scams-and-frauds">https://www.usa.gov/scams-and-frauds</a></p>
                            </li>
                        </ul>
                    </div>

                    <div class="avoid_item report" style="display:none;">
                        <p>Ref: <a href="https://www.usa.gov/scams-and-frauds">https://www.usa.gov/scams-and-frauds</a></p>
                        <p>If you believe you have been a victim of an internet-related crime, report it to these government authorities:</p>

                        <ul>
                            <li><p>The Internet Crime Complaint Center (IC3) refers internet-related criminal complaints to federal, state, local, or international law enforcement. Keep in mind; you will need to contact your credit card company directly to notify them if you are disputing unauthorized charges on your card or if you suspect that your credit card number has been compromised.</p></li>
                            <li><p>The Federal Trade Commission (FTC) shares consumer complaints covering a wide range of categories, including online scams, with local, state, federal, and foreign law enforcement partners. It cannot resolve individual complaints, but can give you information on the next steps to take.</p></li>
                            <li><p>EConsumer.gov accepts complaints about online and related transactions with foreign companies.</p></li>
                            <li><p>The Department of Justice (DOJ) helps you report computer, internet-related, or intellectual property crime to the proper agency based on the scope of the crime.</p></li>
                        </ul>
                        <br>
                        <label for="">Report Telephone Scams</label>
                        <p>It's important to report phone scams to federal agencies. They can’t investigate individual cases. But your report can help them collect evidence for lawsuits against scammers.</p>
                        <ul>
                            <li>
                                <p>Report telephone scams online to the Federal Trade Commission. You can also call 1-877-382-4357. The FTC is the primary government agency that collects scam complaints.</p>
                            </li>
                            <li>
                                <p>Report all robocalls and unwanted telemarketing calls to the Do Not Call Registry.</p>
                            </li>
                            <li>
                                <p>Report caller ID spoofing to the Federal Communications Commission either online or by phone at 1-888-225-5322.</p>
                            </li>
                        </ul>
                        <p>For more help in resolving consumer issues, you can report scams to your state consumer protection office.</p>
                        <br>
                        <label for="">Report Banking Scams</label>
                        <p>The proper organization to report a banking scam to depends on which type you were a victim of.</p>
                        <ul>
                            <li>
                                <p>Report fake checks you receive by mail to the US Postal Inspection Service.</p>
                            </li>
                            <li>
                                <p>Report counterfeit checks to the Federal Trade Commission, either online or by phone at 1-877-382-4357.</p>
                            </li>
                            <li>
                                <p>Contact your bank to report and stop unauthorized automatic withdrawals from your account.</p>
                            </li>
                            <li>
                                <p>Forward phishing emails to the Federal Trade Commission at <a href="mailto:spam@uce.gov"><b>spam@uce.gov</b></a> .</p>
                            </li>
                        </ul>
                        <p>For more help in resolving consumer issues, you can report scams to your state consumer protection office.</p>
                        
                        <br>
                        <label for="">Report Charity Scams</label>
                        
                        <ul>
                            <li>
                                <p>Your state consumer protection office can accept and investigate consumer complaints.</p>
                            </li>
                            <li>
                                <p>File a complaint with the Federal Trade Commission (FTC). The FTC does not resolve individual matters. But it does track charity fraud claims and sues companies on the behalf of consumers.</p>
                            </li>
                            <li>
                                <p>Contact the National Center for Disaster Fraud, if the suspected fraud is because of a natural disaster.</p>
                            </li>                            
                        </ul>
                        <p>The Do Not Call Registry doesn’t apply to charities. But you can ask an organization not to contact you again.</p>

                        <br>
                        <label for="">Report ticket Scams</label>
                        <p>There are several options to report a ticket scam.</p>
                        <ul>
                            <li>
                                <p>Contact your state consumer protection office.</p>
                            </li>
                            <li>
                                <p>Contact the Federal Trade Commission (FTC) using the Online Complaint Assistant.</p>
                            </li>
                            <li>
                                <p>File a local police report, especially if you met the scammer in person or have a picture of them to give the police.</p>
                            </li> 
                            <li>
                                <p>Report it using the Better Business Bureau’s Scam Tracker.</p>
                            </li> 
                            <li>
                                <p>If you paid by credit card, report the problem to the card company. You may be able to dispute the charge.</p>
                            </li>                           
                        </ul>
                         
                        <br>
                        <label for="">Report Lottery and Sweepstakes Scams</label>
                        <p>To report a prize scam:</p>
                        <ul>
                            <li>
                                <p>Contact the Federal Trade Commission online or by phone at 1-877-382-4357.</p>
                            </li>
                            <li>
                                <p>Contact a postal inspector if the scam uses U.S. mail to further its scheme. It doesn’t matter if the scam notice arrived by phone or email.</p>
                            </li>
                            <li>
                                <p>Report robocalls and unwanted telemarketing calls to the Do Not Call Registry.</p>
                            </li>                                                     
                        </ul>
                        <p>Federal agencies investigate scams and pursue criminal charges against the scammers. They don’t, however, investigate individual cases. State consumer protection offices might pursue individual cases as well as investigate scams.</p>

                        <br>
                        <label for="">Report Lottery and Sweepstakes Scams</label>
                        <p>Report pyramid schemes to:</p>
                        <ul>
                            <li>
                                <p>Your state consumer protection office</p>
                            </li>
                            <li>
                                <p>The Federal Trade Commission</p>
                            </li>                                                                                
                        </ul>

                        <br>
                        <label for="">Report Investment Scams</label>
                        <p>Report investment scams, if you have been a victim.</p>
                        <ul>
                            <li>
                                <p>File a complaint about an investment or an investment account with the Securities and Exchange Commission (SEC).</p>
                            </li>
                            <li>
                                <p>Report pyramid or Ponzi schemes to the Federal Trade Commission (FTC).</p>
                            </li>
                            <li>
                                <p>Report investment scams by state-licensed companies to your state's securities administrator.</p>
                            </li>                                                                               
                        </ul>
                        <p>The SEC may forward your complaint to the investment company. It will request that the company reply to your complaint. The FTC will not research your individual case of investment fraud.</p>

                        <br>
                        <label for="">Report Census Related Fraud</label>
                        <p>If you suspect fraud, report it to the Census Bureau’s regional office for your state. Forward scam emails to the Census Bureau at ois.fraud.reporting@census.gov.</p>
                        
                        <br>
                        <label for="">Report Ponzi Schemes</label>
                        <p>Report Ponzi schemes to:</p>
                        <ul>
                            <li>
                                <p>The Securities and Exchange Commission (SEC)</p>
                            </li>
                            <li>
                                <p>The Financial Industry Regulatory Authority</p>
                            </li>
                            <li>
                                <p>Your state's securities administrator</p>
                            </li>                                                                               
                        </ul>    
                        
                        <br>
                        <label for="">Report Grant Scams</label>
                        <ul>
                            <li>
                                <p>If you think you’ve been a victim of a government grant scam, report it to the Federal Trade Commission. You can file a complaint with the FTC online, or call toll-free 1-877-FTC-HELP (1-877-382-4357); TTY: 1-866-653-4261. The FTC enters fraud-related complaints into a database available to law enforcement agencies in the U.S. and abroad.</p>
                            </li>
                            <li>
                                <p>If you’ve paid a fee to learn about or apply for a government grant, you can report it to your state consumer protection office. The government does not charge for information or applications for federal grants.</p>
                            </li>                                                                                                      
                        </ul>            
                    </div>

                    <div class="avoid_item phone_scam" style="display:none;">
                        <p>Ref: <a href="https://www.usa.gov/scams-and-frauds">https://www.usa.gov/scams-and-frauds</a></p>
                        <p>Telephone scammers try to steal your money or personal information. Scams may come through phone calls from real people, robocalls, or text messages. The callers often make false promises, such as opportunities to buy products, invest your money, or receive free product trials. They may also offer you money through free grants and lotteries. Some scammers may call with threats of jail or lawsuits if you don’t pay them.</p>
                        <label for="">How to Protect Yourself from Telephone Scams</label>
                        <p>Remember these tips to avoid being a victim of a telephone scam:</p>
                        <label for="">Do</label>
                        <ul>
                            <li>
                                <p>Register your phone number with the National Do Not Call Registry. You may register online or by calling 1-888-382-1222. If you still receive telemarketing calls after registering, there’s a good chance that the calls are scams.</p>
                            </li>
                            <li>
                                <p>Be wary of callers claiming that you’ve won a prize or vacation package.</p>
                            </li>
                            <li>
                                <p>Hang up on suspicious phone calls.</p>
                            </li>
                            <li>
                                <p>Be cautious of caller ID. Scammers can change the phone number that shows up on your caller ID screen. This is called “spoofing.”</p>
                            </li>                                                                               
                            <li>
                                <p>Independently research business opportunities, charities, or travel packages being offered by the caller.</p>
                            </li>   
                        </ul>    
                        <label for="">Don't</label>
                        <ul>
                            <li>
                                <p>Don’t give in to pressure to take immediate action.</p>
                            </li>
                            <li>
                                <p>Don’t say anything if a caller starts the call asking, “Can you hear me?” This is a common tactic for scammers to record you saying “yes.” Scammers record your “yes” response and use it as proof that you agreed to a purchase or credit card charge.</p>
                            </li>
                            <li>
                                <p>Don’t provide your credit card number, bank account information, or other personal information to a caller.</p>
                            </li>
                            <li>
                                <p>Don’t send money if a caller tells you to wire money or pay with a prepaid debit card.</p>
                            </li>
                        </ul> 

                    </div>

                    <div class="avoid_item email_scam" style="display:none;">
                        <p>Check the link below more about scams:</p>
                        <p><a href="https://www.usa.gov/scams-and-frauds">https://www.usa.gov/scams-and-frauds</a></p>
                        <br>
                        <p>Are you sure the email you received on your bank name is really from your bank? </p>
                        <p>Are you sure your account is really suspended and needs your verification?</p>
                        <p>Are you sure the home page that looks like your bank login page is really you bank login page?</p>
                        <br>
                        <p>Scammers always try to get your personal information or sensitive information by simply showing login window that looks same as the one you visit frequently. Once you enter your credentials and click on login button, the page redirects to the actual site asking same info again.</p>
                        <br>
                        <p>What is Phishing? </p>
                        <p>Check the link below to learn how hackers steal your information and tips to protect yourself.</p>
                        <p><a href="https://www.securitymetrics.com/blog/7-ways-recognize-phishing-email">https://www.securitymetrics.com/blog/7-ways-recognize-phishing-email</a></p>
                        <br>
                        <p>Following are some examples and cases reported by victims…</p>
                        <br>
                        <p><b>Example:</b></p>
                        <img src="{{ asset('img/footer_tips/avoid_mail.png') }}" alt="">
                    </div>
                </div>
            </div> 
                
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        $(".btn_nav_item").click(function(){
            $(".btn_nav_item").removeClass("border_bottom_2");
            $(this).addClass("border_bottom_2");
            if($(this).hasClass("btn_safty_tips"))
            {
                $(".avoid_item").css("display","none");
                $(".safty_tips").css("display","block");
            }
            else if($(this).hasClass("btn_email_scams"))
            {
                $(".avoid_item").css("display","none");
                $(".email_scam").css("display","block");
            }
            else if($(this).hasClass("btn_phone_scam"))
            {
                $(".avoid_item").css("display","none");
                $(".phone_scam").css("display","block");
            }
            else if($(this).hasClass("btn_other_resources"))
            {
                $(".avoid_item").css("display","none");
                $(".other_resources").css("display","block");
            }
            else if($(this).hasClass("btn_report"))
            {
                $(".avoid_item").css("display","none");
                $(".report").css("display","block");
            }
        });
    });    
</script>
@endsection