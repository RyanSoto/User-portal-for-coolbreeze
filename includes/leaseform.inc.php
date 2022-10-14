<?php 
    session_start();
    if (!isset($_SESSION["useruid"]))
    {
        header("location:login.php?error=notloggedin");
        exit();
    } else 

    if  ($_SESSION["usertype"] == "user") {
        header("location: login.php?error=notadmin");
        exit();
    }

require('../fpdf/fpdf.php');
class PDF extends FPDF


{

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
protected $B = 0;
protected $I = 0;
protected $U = 0;
protected $HREF = '';

function WriteHTML($html)
{
    // HTML parser
    $html = str_replace("\n",' ',$html);
    $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
    foreach($a as $i=>$e)
    {
        if($i%2==0)
        {
            // Text
            if($this->HREF)
                $this->PutLink($this->HREF,$e);
            else
                $this->Write(5,$e);
        }
        else
        {
            // Tag
            if($e[0]=='/')
                $this->CloseTag(strtoupper(substr($e,1)));
            else
            {
                // Extract attributes
                $a2 = explode(' ',$e);
                $tag = strtoupper(array_shift($a2));
                $attr = array();
                foreach($a2 as $v)
                {
                    if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                        $attr[strtoupper($a3[1])] = $a3[2];
                }
                $this->OpenTag($tag,$attr);
            }
        }
    }
}

function OpenTag($tag, $attr)
{
    // Opening tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,true);
    if($tag=='A')
        $this->HREF = $attr['HREF'];
    if($tag=='BR')
        $this->Ln(5);
}

function CloseTag($tag)
{
    // Closing tag
    if($tag=='B' || $tag=='I' || $tag=='U')
        $this->SetStyle($tag,false);
    if($tag=='A')
        $this->HREF = '';
}

function SetStyle($tag, $enable)
{
    // Modify style and select corresponding font
    $this->$tag += ($enable ? 1 : -1);
    $style = '';
    foreach(array('B', 'I', 'U') as $s)
    {
        if($this->$s>0)
            $style .= $s;
    }
    $this->SetFont('',$style);
}

function PutLink($URL, $txt)
{
    // Put a hyperlink
    $this->SetTextColor(0,0,255);
    $this->SetStyle('U',true);
    $this->Write(5,$txt,$URL);
    $this->SetStyle('U',false);
    $this->SetTextColor(0);
}
}


$owner = 'Robert Soto';
$ownerAdd = $_POST["ownerAdd"];
$tenant = $_POST["tenant"];
$address = $_POST["address"];
$depoAmount = $_POST["depoAmount"];
$todayDay = $_POST["todayDay"];
$todayMonth = $_POST["todayMonth"];
$todayYear = $_POST["todayYear"];
$leaseTerm= $_POST["leaseTerm"];
$lsday= $_POST["lsday"];
$lsmonth= $_POST["lsmonth"];
$lsyear= $_POST["telsyearnant"];
$leday= $_POST["leday"];
$lemonth= $_POST["lemonth"];
$leyear= $_POST["leyear"];
$rentTot= $_POST["rentTot"];
$rentMon= $_POST["rentMon"];
$prorate= $_POST["prorate"];
$occupanymax= $_POST["occupanymax"];
$maxVehicles= $_POST["maxVehicles"];
$specialProv= $_POST["specialProv"];

$fileName = $tenant . "Lease.pdf";


//FPDF Start
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

//Head
$pdf->SetFillColor(200);
$pdf->SetFont('Arial', '', 20);
$pdf->Cell(0,10, 'Residential Lease Agreement', 1, 1, 'C', true);
$pdf->Ln(10);

//Body
$pdf->SetFont('Arial', '', 12);


$num1 = '1. Parties. THIS AGREEMENT  made this <u>  '.$todayDay. '  </u> day of <u>   '.$todayMonth.'   </u>, 20<u>'.$todayYear. '  </u>, by and between <br> <u>      '.$owner.'      </u>, herein called "Landlord,
" and <u>      '.$tenant.'      </u>, herein called [Tenant (s)]. The term "Tenant" refers to all of the above tenants unless otherwise indicated. ';

$pdf->WriteHTML($num1);
$pdf->Ln(10);

$num2= ' 2.  Leased  Premises.   Landlord hereby agrees to lease to Tenant, and Tenant hereby leases from Landlord, that certain property with the improvements thereon, 
hereafter called the "Leased Premises" located at (mailing address), <u>      '.$address.'      </u>, or as described on attached exhibit, for use as a private residence only.';
$pdf->WriteHTML($num2);
$pdf->Ln(10);

$num3= '3.  Lease Term.  The term of this Lease shall be for a period of <u>   '.$leaseTerm.'   </u>
Beginning, on the <u>  '.$lsday. '  </u> day of <u>   '.$lsmonth.'   </u>, 20<u>'.$lsyear. '  </u>, and ending on the  <u>  '.$leday. '  </u> day of <u>   '.$lemonth.'   </u>, 20<u>'.$leyear. '  </u>.
This Lease will be automatically renewed on a month-to month basis unless written notice of termination is given by either party at least 30 days before the end of the above lease term or any renewal or extension period, or unless another lease is signed by both parties.  When renewed on a month-to-month basis, and until both parties sign another lease agreement for a specific period, either party may terminate this Lease with 30-day written notice.  If occupancy of the Leased Premises is delayed because of construction or prior tenant\'s holding over, Landlord shall not be liable to Tenant for such delay, and this Lease shall remain in force subject to the following conditions: (i) rentals shall be abated on a daily basis during delay, and (ii) Tenant may terminate by giving notice in writing to Landlord no later then the third day of delay, whereupon Tenant shall be entitled only to refund of Deposit(s) and any rents paid.  Such conditions shall not apply to cleaning and repair delays.
';
$pdf->WriteHTML($num3);
$pdf->Ln(10);

$num4= '4.  MOVE-OUT NOTICE AND RELETTING BY LANDLORD. At least  (30) days written notice of intent to vacate must be given to Landlord or Landlord\'s Representative prior to move-out at the end of the above lease term or renewal or extension period. VERBAL NOTICE IS INSUFFICIENT UNDER ANY CIRCUMSTANCES.  In the event of automatic renewal or extension, the lease term shall extend to and the rent shall be paid through the last day of the month following the expiration of the 30-day notice period; in other words, the last month\'s rent must be paid for a full month without any proration.  Failure to give the 30-day written move-out notice will subject Tenant to liability for further rentals, cost of reletting charge in the amount of  $350 and other damages and charges into which the Landlord is entitled.  Should Tenant vacate the Leased Premises without rent being paid in full for the entire lease term or renewal or extension period, Landlord shall use diligence to relet and Tenant shall be charged for costs of reletting regardless of whether or not reletting attempts are successful. It is to the mutual benefit of both Tenant and Landlord to stipulate in advance the costs of reletting because it is difficult to evaluate such costs as inconvenience, paperwork, advertising, showing Leased Premises, air conditioning and utilities for showing, checking proper prospects, administrative and office overhead, and locator service fee (all of which may vary greatly).  Therefore, it is agreed that costs of reletting shall be a liquidated sum as stipulated, regardless of whether the actual costs are greater or lesser.  This amount shall be in addition to past due rentals, future rentals and/or charges for cleaning, repairing, repainting or other sums due under this Lease and the foregoing shall not waive or diminish Landlord\'s right to recover such additional amounts.  All subsequent rentals received shall be credited against Tenant\'s liability for future rentals.';
$pdf->WriteHTML($num4);
$pdf->Ln(10);

$num5= '5.  RENT. Tenant agrees to and shall pay Landlord at (mailing address) <u>      '.$ownerAdd.'      </u>,
Or at such other place Landlord shall designate from time to time in writing, as rent for the Leased Premises, the total sum of <u>      $'.$rentTot.'      </u>, payable in advance and without demand in equal monthly payments of <u>      $'.$rentMon.'      </u> on or before the 
<u>  10th  </u> Day of each month and continuing thereafter until the total sum shall be paid.  The prorated rent from the date of move-in to the first day of the following month is <u>      $'.$prorate.'      </u>. The prorated portion is payable on the first day of the second month of occupancy.  One full month\'s rent is due on move-in.  If any rental payment is not paid in full on or before the <u>  10th  </u> day of the month, Tenant agrees to pay a late charge of <u>  $35  </u>  , plus an additional late charge of <u>  $1  </u> per day thereafter until rental payment is paid in full. Tenants right to possession and Landlord\'s obligations are expressly contingent upon the prompt payment of rent, and the use of the Leased Premises by Tenant is obtained only on the condition that rent is paid in full on time.  Landlord may require that all monthly payment be paid in one monthly check rather than multiple checks.  All monies received by Landlord shall be applied first to non-rent obligations of the Tenant, including late charges, charges for returned checks, and pet penalties, if any, then to rent, regardless of notation on the check.  At Landlords option, Landlord may at any time require all rent and other sums be paid in cash, cashier\'s check, certified check or money order. 
';
$pdf->WriteHTML($num5);
$pdf->Ln(10);

$num6= '6.  SECURITY DEPOSIT.  Tenant agrees to pay Landlord on or before the execution of this Lease the sum of <u>      $'.$depoAmount.'      </u> as a security deposit(Deposit), for the faithful performance of the terms and conditions of this Lease by Tenant.  This Deposit shall not be constructed as rent, and any attempt by Tenant to withhold payment of the last month\'s rent on the grounds the Deposit serves as security for unpaid rent is a violation of V.T.C.A. Property Code ð 92.108. At least (30) days written notice of intent to vacate must be given to Landlord for refund of Deposit.  Refunds shall be made in accordance with this Lease.  Tenants shall not be entitled to interest on the Deposit.';
$pdf->WriteHTML($num6);
$pdf->Ln(10);

$num7= '7. DEPOSIT DEDUCTIONS. There shall be deducted from the Deposit appropriate charges for:  (I) unpaid rent including late charges; (ii) unpaid utilities; (iii) cleaning , damages and required repairs to the Leased Premises or its contents beyond normal wear and tear; (iv) replacing unreturned keys and/or change of locks; (v)  cost of removing unauthorized locks;(vi) removing and storing abandoned property; (vii)removing abandoned or illegally parked vehicles; (viii) cost of pest control if required by Landlord; (ix) trips to admit telephone or cable TV representatives for removal of Tenant\'s service; (x) insufficient light bulbs; (XI) stickers, scratches, burns, stains or holes, etc., in walls doors, floors draperies, carpets, and/or furniture;(xii) agreed cost of reletting; (xiii) attorney\'s fees and court costs incurred in any eviction proceeding against Tenant; and (xiv) other charges provided for herein or agreed to by the parties hereto.  Deposit will be first applied to non-rent  items, including late charge, charges for returned check, and pet penalty, if any, then to unpaid rent.  Any balance of the Deposit shall be refunded to the Tenant by mail within thirty (30) days of the date Tenant surrenders the Leased Premises and keys and delivers Tenant\'s forwarding address to Landlord in writing in accordance with State Law.  Landlord shall provide Tenant a written description and itemized list of any deductions.  The Landlord is not required to give the Tenant a description and itemized list of deductions if the Tenant owes rent when he/she surrenders possession of the premises and there is no controversy concerning the amount of rent owed.  If deductions exceed the Deposit, Tenant agrees to pay Landlord the amount due within ten (10) days of written notice to Tenant by Landlord.';
$pdf->WriteHTML($num7);
$pdf->Ln(10);


$num8= '<del>8.  UTLITIES. Tenant shall pay for electricity, gas water, telephone, and cable TV for Leased premises unless otherwise indicated in Paragraph 32 below.  Utilities shall be used only for normal household purposes and not wasted. </del>';
$num8del= '<del>'.$num8.'</del>';
$pdf->WriteHTML($num8);
$pdf->Ln(10);

$num9= '9.  USE OF LEASED PREMISES.  The Leased Premises shall be used as a private dwelling only, with the total number of adults and children residing therein not to exceed 
<u>      '.$occupanymax.'      </u>.   Tenant shall not permit the Leased Premises or any part thereof to be used for (I) the conduct of any offensive, noisy, or dangerous activity; (ii) repair of any vehicle; (iii) the conduct of any business of any type, including child care; (iv) the conduct of any activity which violates any applicable deed, homeowners or subdivision
restrictions; or (v) any purpose or in any manner which will obstruct, interfere with, or infringe on the rights of other persons near the Leased Premises.  Tenant shall not permit more than <u>      '.$maxVehicles.'      </u> vehicles (including but not limited to automobiles, trucks,
recreational vehicles, trailers, motorcycles and boats) on the Leased Premises unless authorized by Landlord in writing.  Non-operative vehicles shall not be stored on the Leased Premises or on the street in front of or adjacent to the Leased Premises.  Any
of Tenant\'s vehicles which are deemed inoperable may be towed by Landlord or Landlord\'s Representative at Tenant\'s expense.  The Leased Premises which are reserved for Tenant\'s private use shall be kept clean and sanitary by Tenant.  Garbage shall be disposed of only in appropriate receptacles.  Tenant shall be liable to Landlord for 
damages caused by Tenant, Tenant\'s guests, or occupants.  Guests may not stay in the  
Leased Premises longer than ten (10) consecutive days without Landlord\'s written permission.  If provided, Landlord\'s written Rules and Regulations are hereby made a part of this Lease, and violation of the Rules and Regulations by Tenant, Tenant\'s guests or other occupants of the Leased Premises shall be deemed a violation of this Lease.
Landlord\'s Rules and Regulations include those imposed by either a condominium association or multi-tenant complex.
';
$pdf->WriteHTML($num9);
$pdf->Ln(10);

$num10= '10.  RESPONSIBILITY FOR CONDITION OF LEASED PREMISES.  Tenant has thoroughly inspected and accepts the Leased Premises as is except for conditions materially affecting the health or safety of ordinary persons, and Landlord has made no implied warranties as to the condition of the Leased Premises and no agreements have been made regarding future repairs unless specified in this Lease.  A Move-In Inventory and Condition Form will be provided to Tenant on or before move-in.  The Move-in Inventory and Condition Form is to report the condition of the Leased Premises and is not a request for maintenance or repairs.  Within 48 hours after move-in, Tenant shall note any defects or damages to the Leased Premises on the form and deliver or mail said form to Landlord; failure of Tenant to return form to Landlord shall be deemed as Tenant\'s acceptance of the Leased Premises to be in clean and good condition.  Landlord has provided locks and smoke detectors as required by law.  Tenant has inspected the existing locks and latches and agrees that they are safe and acceptable, subject to Landlord\'s duty to make needed repairs of same upon written request of Tenant.  Any additional locks or
smoke detectors desired by Tenant may be installed at Tenant\'s expense only after written approval from Landlord.  When installed, any additional items shall become the property of Landlord.  Tenant shall use reasonable diligence in the care of the Leased Premises and shall be responsible for: (i) costs of plumbing stoppages and damages from same caused by foreign or improper objects and not caused by Landlord\'s negligence in lines exclusively serving the Tenant\'s dwelling; (ii) damages to doors, windows, or screens not caused by Landlord\'s negligence; (iii) damages from windows or doors left open; (iv) supplying and changing heating and air conditioning filters at monthly intervals; (v) supplying and replacing light bulbs and smoke detector batteries; (vi) maintaining and watering the yard, including shrubbery; any replacement due to Tenant\'s neglect in watering or maintenance shall be at Tenant\'s expense; any alteration of existing landscape must have written approval of Landlord; (vii) prompt removal of trash from the Leased Premises; (viii) eliminating any condition that may be dangerous to health and safety; (ix) cost of pest control except for wood destroying insects; (x) taking precautions to preclude broken water pipes due to freezing; (xi) lost or misplaced keys; (xii) damages resulting from Tenant\'s failure to promptly notify Landlord of needed repairs; 
Tenant shall NOT:  (I) make any repairs or alterations to the Leased Premises without permission from Landlord; (ii) remove any part of the Leased Premises or Landlord\'s property for any purpose; (iii) remove, change, or re-key any lock without permission of Landlord; (iv) make holes in the woodwork, floors or walls except that a reasonable number of small nails may be used to hang pictures in sheetrock walls and grooves of paneling; (v) permit any water furniture in the Leased Premises without written permission of Landlord; (vi) install new or additional telephone or cable outlets without permission of Landlord; or (vii) replace, remove or shampoo carpet, paint or wallpaper without written permission of Landlord.  Tenant agrees to surrender the Leased Premises
at the end of the term of this Lease and any extension or renewal thereof in the same condition as when received, normal wear and tear excepted.  Normal wear and tear means deterioration which occurs without negligence, carelessness, accident or abuse.
';
$pdf->WriteHTML($num10);
$pdf->Ln(10);

$num11= '11.  LIABILITY.  Landlord or Landlord\'s Representatives shall not be liable to Tenant, Tenant\'s guests, or other occupants, for any damages, injuries, or losses to person or property caused by fire, flood, water leaks, ice, snow, hail, winds, explosion, smoke, interruption of utilities, theft, burglary, robbery, assault, vandalism, other persons, condition of the Leased Premises, or other occurrences or casualty losses unless such damage or injury is caused by the gross negligence of Landlord or Landlord\'s Representative.  Tenant agrees to notify Landlord immediately of any dangerous or potentially dangerous conditions on or about the Leased Premises.  Landlord strongly recommends that Tenant secure his own insurance coverage for protection against such 
liabilities and losses.  If Landlord, Landlord\'s Representatives, agents or employees are requested to render services not contemplated in this Lease, Tenant agrees to hold harmless Landlord and the others named above from all liability in connection with such services.
';
$pdf->WriteHTML($num11);
$pdf->Ln(10);

$num12= '12.  LANDLORD\'S RESPONSIBILITY FOR REPAIRS.  All requests by Tenant for repairs to be made by Landlord must be directed to Landlord or Landlord\'s Representatives in writing except those caused by fire, interruption of utilities or such other emergency.  LANDLORD\'S DEFINITION OF EMERGENCIES:  Problems that Landlord is liable for and materially affect the health of safety of an ordinary Tenant.  An emergency is not a condition that merely causes inconvenience or discomfort to a Tenant.  The Landlord does not have a duty to repair or remedy a condition caused during the term of this Lease by the Tenant, a lawful occupant in the Tenant\'s dwelling, a member of the Tenant\'s family, or a guest of the Tenant unless the condition was caused by normal wear and tear. Landlord shall have the right to temporarily discontinue utilities and the use of any fixtures or appliances by Tenant if the interruption results from bona fide repairs, construction, or an emergency.  Landlord shall act with due diligence but shall not be obligated to make repairs on other than a business day except in the event of an emergency.  No deductions shall be allowed in the rent during reasonable periods of repair to the Leased Premises and this Lease shall remain in full force.  If, in the opinion of Landlord, the Leased Premises are substantially damaged by fire or other casualty loss, Landlord may terminate this Lease upon reasonable notice to Tenant.  In this event, the rent shall be prorated to the date of termination and Deposit(s) refunded less lawful deductions.';
$pdf->WriteHTML($num12);
$pdf->Ln(10);

$num13= '13.  REIMBURSEMENT.  Tenant shall promptly reimburse Landlord for any loss, property damage, or cost of repairs or service to the dwelling caused by negligence or by improper use by Tenant, Tenant\'s guests, or other occupants unless repairs have been properly made by Tenant pursuant to requirements or permission set forth in this Lease.
Such reimbursement is due when Landlord makes demand, Landlord\'s failure or delay in  demanding damage reimbursement, late payment charges, returned check charges, or other sums due by Tenant shall not be deemed a waiver and Landlord may require payment of same at any time, including deductions from Deposit.  Landlord may require advance payment of repairs for which Tenant is liable.
';
$pdf->WriteHTML($num13);
$pdf->Ln(10);

$num14= '14.  LANDLORD ACCESS.  Landlord, Landlord\'s Representatives and other persons specifically authorized by either of them may enter the Leased Premises by reasonable means at reasonable times without notice to:  (i) inspect the Leased Premises; (ii) make repairs; (iii) show the Leased Premises to prospective Tenant or purchasers, governmental inspectors, fire marshals, lenders, appraisers, insurance agents; and (iv) exercise a contractual lien. ';
$pdf->WriteHTML($num14);
$pdf->Ln(10);

$num15= '15.  DEFAULT BY TENANT.  If  Tenant fails to pay rent or other lawful charges when due or if Tenant fails to reimburse Landlord for damages, repairs, or other costs when due as provided in this Lease, or if Tenant abandons the Leased Premises, or if Tenant, Tenant\'s guests or other occupants violate this Lease or Landlord\'s Rules and Regulations (if provided) or applicable state or local laws, Landlord or Landlord\'s Representative may terminate Tenant\'s right of occupancy by giving Tenant three (3) days\' notice to vacate in writing; except however, notice may be by mail or personal delivery to Tenant or left in a conspicuous place inside the Leased Premises.  Such termination does not release Tenant from liability for future rentals, Landlord\'s acceptance of rent or other sums due after Landlord gives Tenant notice to vacate or after Landlord files eviction suit shall not diminish Landlord\'s right of eviction and shall not waive Landlord\'s right of property damage, past or future rent, or other sums due.  If Landlord prevails in any suit for eviction, unpaid rentals, charges or damages, Tenant shall be liable for Landlord\'s administrative costs, court costs and reasonable attorney\'s fees and all amounts shall bear 10% interest from due date.  If Tenant\'s rent is delinquent, Landlord shall not be obligated to continue utilities which are furnished and paid for by Landlord.  Landlord may report unpaid rentals or unpaid damages to the local credit bureau for permanent recordation in Tenant\'s credit record.';
$pdf->WriteHTML($num15);
$pdf->Ln(10);

$num16= '16. TENANT\'S REMEDIES FOR LANDLORD\'S FAILURE TO REPAIR OR REMEDY A CONDITION.  Where Landlord has a duty to repair or remedy a condition materially affecting the physical health or safety of an ordinary tenant, Tenant may terminate this Lease, withhold rent, offset rent against needed repairs, or pursue judicial remedies only when the following procedures are followed: (l) the Tenant has given Landlord prior written notice to repair or remedy a condition which materially affects the physical health or safety of an ordinary tenant; (2) the Landlord has had a reasonable time to repair or remedy the condition, considering the nature of the problem and the reasonable availability of materials, labor, and utilities from a utility company; (3) the Landlord has not made a diligent effort to repair or remedy the condition; (4) the Tenant has given subsequent written notice to Landlord stating that Tenant intends to terminate the lease, exercise repair and deduct remedies, or pursue judicial remedies; and (5) the Tenant is not delinquent in the payment of rent when the notices were given.';
$pdf->WriteHTML($num16);
$pdf->Ln(10);

$num17= '17.  ACCELERATION.  If, in violation hereof, Tenant or Tenant\'s agent gives notice of intent to move out more than thirty (30) days prior to the end of the lease term or renewal or extension period, or if Tenant moves out or removes property from the Leased Premises in contemplation of moving therefrom prior to the end of the lease term or renewal or extension period, or if Tenant is evicted by court order, then all monthly rentals which are payable during the remainder of the lease term or renewal or extension period shall be accelerated without notice or demand and shall be immediately due and payable.  Such right of acceleration is in lieu of having rentals for the entire lease term payable at the beginning of the Lease.';
$pdf->WriteHTML($num17);
$pdf->Ln(10);

$num18= '18.  HOLDOVER.  If Tenant fails to vacate on or before the required move-out date (i.e., the end of the lease term or renewal or extension period after proper move-out or vacate notice has been given under Paragraph 4, or a different move-out date agreed to by the parties in writing), Tenant shall be liable to pay rent for the holdover period and to indemnify Landlord and/or prospective tenants for damages (including lost rentals, lodging expenses, and attorney\'s fees); and at Landlord\'s option, Landlord may extend the lease term for up to one month from the date of notice of lease extension date by delivering written notice to Tenant or Tenant\'s dwelling while Tenant is still holding over.  Rent for any holdover period shall be immediately due and payable on a daily basis and delinquent without notice or demand.  Tenant understands and acknowledges that Tenant will be considered in possession of Leased Premises and liable for payment of rent for the holdover period until all keys to the Leased Premises are returned to Landlord and all personal property is removed.';
$pdf->WriteHTML($num18);
$pdf->Ln(10);

$num19= '19.  CONTRACTUAL LIEN.  To secure payment of delinquent rent under this Lease, all personal property on the Leased Premises and property that Tenant has stored in any storage room (except the property exempted by statute) is hereby subject to a contractual landlord\'s lien.  This contractual lien is in addition to the statutory landlord\'s lien provided by Section 54.041 of the Property Code.  In order to exercise contractual
lien rights, Landlord or Landlord\'s Representative may peacefully enter the Leased Premises (and any storage facilities) and remove and store all property therein, except property exempt by statute; immediately after seizing non-exempt property, the Landlord or Landlord\'s Representative shall leave in a conspicuous place within the dwelling, written notice of entry and an itemized list of the items removed.  The Notice must state the amount of delinquent rent and the name, address, and telephone number of the person the Tenant may contact regarding the amount owed.  The notice must also state that the property will be promptly returned on full payment of the delinquent rent.  Landlord is entitled to collect a charge for packing, removing, and/or storing property seized.  If Tenant has abandoned the premises, or has been evicted by judicial process, Landlord or Landlord\'s Representative, may peacefully enter, remove, and store all property still remaining on or in the Leased Premises.  There shall be no sale or disposition of any of the foregoing property except pursuant to this Lease.  Landlord may sell such property at a public or private sale (subject to any recorded chattel mortgage or financing statement) after thirty (30) days\' written notice of time and place of sale is sent to Tenant by both first class mail and certified mail, return receipt requested, at Tenant\'s last known address.  The notice must contain: (1) the date, time and place of the sale; (2) an itemized account of the amount owed by the Tenant to the Landlord; and (3) the name, address and telephone number of the person the Tenant may contact regarding the sale, the amount owed, and the right of the Tenant to redeem the property at any time before the property is sold by paying the Landlord or the Landlord\'s Representative all delinquent rents and reasonable packing, moving, and storage costs.  The sale of the non-exempt property shall be to the highest cash bidder with proceeds applied first to delinquent rents, packing, moving, storage and sale costs.  Surplus proceeds, if any, shall be mailed to Tenant at Tenant\'s last known address not later than the 30th day after the date of the sale.  Landlord shall provide Tenant with an accounting of all proceeds of the sale not later than the 30th day after the date on which Tenant makes a written request for the accounting.  It is agreed that none of the above procedures shall necessitate prior court hearing or subject Landlord to any liability.  Tenant hereby specifically waives any right he/she may have for a due process hearing prior to the removal of property.
';
$pdf->WriteHTML($num19);
$pdf->Ln(10);

$num20= '20.  CLEANING.  The Leased Premises, including bathrooms, furniture, and appliances, must be cleaned thoroughly. If Tenant fails to clean in accordance with the above, reasonable charges to complete such cleaning shall be deducted from the Deposit including but not limited to charges for cleaning carpets, draperies, furniture, walls, etc.';
$pdf->WriteHTML($num20);
$pdf->Ln(10);

$num21= '21.  PETS.  Tenant shall not permit any pet on the Leased Premises, even temporarily, unless otherwise agreed to by Landlord in writing.';
$pdf->WriteHTML($num21);
$pdf->Ln(10);

$num22= '22.  FAILURE TO PAY FIRST MONTH\'S RENT.  All future rent shall be accelerated and immediately due and payable if Tenant fails to pay the first month\'s rent by the first day of the first rental period under this Lease.  In such event, Landlord may terminate Tenant\'s right of occupancy and sue for damages, future rentals, attorney\'s fees, court costs and other lawful charges.';
$pdf->WriteHTML($num22);
$pdf->Ln(10);

$num23= '23.  RENT INCREASES.  No rent increases shall be allowed during the lease term.  At least thirty (30) days prior written notice is required for any rent increase.  If such notice of rent increase is given to Tenant, this Lease shall automatically continue on a month-to-month basis at the increased rental rate beginning on the effective date of rental increase.';
$pdf->WriteHTML($num23);
$pdf->Ln(10);

$num= '24.  ASSIGNMENT AND SUBLETTING AND BINDING NATURE.  Tenant shall not assign this Lease nor sublet the Leased Premises or any interest therein without first obtaining the written consent of Landlord.  An assignment or subletting without the written consent of Landlord shall be void and shall, at the option of Landlord, terminate this Lease.  This Lease shall be binding upon and inure to the benefit of the parties to this Lease and their respective heirs, executors, administrators, legal representatives, successors, and permitted assigns.';
$pdf->WriteHTML($num);
$pdf->Ln(10);

$num25= '25.  SUBORDINATION OF LEASE.  This Lease and Tenant\'s leasehold interest under this Lease are and shall be subject, subordinate, and inferior to any lien or encumbrance now or hereafter placed on the Leased Premises by:  Landlord, to all advances made under any such lien or encumbrance, to the interest payable on any such lien or encumbrance, and to any and all renewals and extensions of any such lien or encumbrances.';
$pdf->WriteHTML($num25);
$pdf->Ln(10);

$num26= '26.  MILITARY.  If Tenant is or becomes a member of the Armed Forces on extended active duty and receives permanent change of station (PCS) orders to leave the County in which Leased Premises is located, or is relieved from such active duty, then Tenant may terminate the Lease by giving thirty (30) days written notice, with certified copy of the military orders attached, provided Tenant is not otherwise in default.  (Military orders authorizing base housing do not constitute grounds for termination unless specially waived.)  ';
$pdf->WriteHTML($num26);
$pdf->Ln(10);

$num27= '27. SIGNS.  During the last <u> 14 </u> days of this Lease, a "For Sale" sign and/or a "For Lease" sign may be displayed on the Leased Premises.';
$pdf->WriteHTML($num27);
$pdf->Ln(10);

$num28= '28.  TIME OF ESSENCE.  Time is expressly declared to be of the essence in this Lease.';
$pdf->WriteHTML($num28);
$pdf->Ln(10);

$num29= '29.  GENERAL.  No oral agreements have been entered into and this Lease shall not be modified unless by written addendum.  This is the entire agreement.  IN THE EVENT OF MORE THAN ONE TENANT, EACH TENANT IS JOINTLY AND SEVERALLY LIABLE FOR EACH PROVISION OF THIS LEASE.  Any act or notice of or to, or refund to, or the signature of, any one or more of the Tenants, in relation to the renewal or termination of this Lease, or with respect to any of the terms of this lease shall be fully binding on all of  the persons executing this Lease as Tenants.  Each of the undersigned states that he/she is of legal age to enter into a binding contract for lodging.  This Lease shall be construed under and in accordance with the laws of the State of Texas and all obligations hereunder are to be performed in the county in which the Leased Premises are located.  In any lawsuit involving contractual or statutory obligations of Landlord or Tenant and originating in justice, county, or district court, the prevailing party shall be entitled to recover attorney\'s fees and all other costs of litigation from the nonprevailing party.  All amounts in any lawsuit judgment shall bear 10% interest from due date.  Unless otherwise stated in this Lease, all sums owed by Tenant are due on demand.  Landlord\'s past delay, waiver, or nonenforcement of acceleration, contractual lien, rental due date, or any other right, shall not be deemed to be a waiver of any other breach by Tenant or any other term, condition, or covenant contained in this Lease.  This Lease is binding on subsequent owners of the Leased Premises.  Any clause in this Lease or addendum, if any, declared invalid by law shall not terminate or invalidate the remainder of this Lease.';
$pdf->WriteHTML($num29);
$pdf->Ln(10);

$num30= '30.  RELATED DOCUMENTS.  Incorporated into this Lease are the following documents (if checked):<br> 
    _____ Tenant\'s Application for Rental<br> 
    _____ Texas Real Estate Commission Agency Disclosure Form(for leases in excess of twelve (12) months)<br> 
    _____ Landlord\'s Rules and Regulations<br> 
    _____ Landlord\'s Addendum to Residential Lease Agreement<br> 
    _____ Move-In Inventory and Condition Form<br> 
    _____ Pet Agreement<br> 
    _____ __________________________________________<br> 
    All Tenant\'s statements in Tenant\'s Application for Rental are material representations relied upon by Landlord or Landlord\'s Representative.  Any misrepresentation shall constitute a breach of this Lease and Landlord may terminate same.	
';
$pdf->WriteHTML($num30);
$pdf->Ln(10);

$num31= '31.  SPECIAL PROVISIONS.  The following special provisions and any addenda or attachments shall control over any conflicting provisions of this printed lease form.
<u>      '.$specialProv.'      </u>
';
$pdf->WriteHTML($num31);
$pdf->Ln(10);

$num32= '32.  CONDEMNATION.  If during the term of this Lease or any extension or renewal of this Lease, all of the Leased Premises are taken for any public or quasi-public use under any governmental law, ordinance, or regulation, or by right of eminent domain, or are sold to the condemning authority under threat of condemnation, this Lease will terminate, and the rent will be abated during the unexpired portion of this Lease, effective as of the date of the taking of the premises by the condemning authority.  If less than all of the Leased Premises are taken for any public or quasi-public use under any governmental law, ordinance, or regulation, or by right of eminent domain, or are sold to the condemning authority under threat of condemnation, Landlord may, at Landlord\'s sole option, either terminate this Lease or restore and reconstruct the building and other improvements situated on the Leased Premises at Landlord\'s own expense.  If Landlord does not terminate this Lease but instead restores and reconstructs the building and other improvements situated on the Leased Premises, then the rent payable during the unexpired portion of this Lease will be adjusted equitably.		 
THIS LEASE AGREEMENT and any addendum hereto has been executed in multiple copies, one for Tenant and one or more for Landlord.
THIS IS A LEGAL DOCUMENT.  READ IT CAREFULLY.  IF YOU DO NOT
UNDERSTAND THE EFFECT OF ANY PART OF THIS AGREEMENT, SEEK COMPETENT LEGAL ADVICE.
';
$pdf->WriteHTML($num32);
$pdf->Ln(40);

$pdf->Cell(15);
$pdf->Cell(60, 6, '' , 'B', 0, 'C');    //Landlord Signature

$pdf->Cell(50);
$pdf->Cell(30, 6, '', 'B', 1, 'C');


$pdf->Cell(15);
$pdf->Cell(60, 6, 'Landlord   '.$owner, 0, 0, 'C');

$pdf->Cell(50);
$pdf->Cell(30, 6, 'Date', 0, 1, 'C');


$pdf->Ln(30);


$pdf->Cell(15);
$pdf->Cell(60, 6, '', 'B', 1, 'C'); //Tenant Signature

$pdf->Cell(15);
$pdf->Cell(60, 6, 'Tenant   '.$tenant, 0, 1, 'C'); 
$pdf->Ln(15);

$pdf->Cell(15);
$pdf->Cell(60, 6, '', 'B', 1, 'C');  //Co-Signer
$pdf->Cell(15);
$pdf->Cell(60, 6, 'Co-Signer', 0, 0, 'C');
$pdf->Cell(40);

$pdf->Output('I', $fileName);

// if (isset($_POST["submit"])) {

//     $pdf->Output('I', $fileName);

// } else if (isset($_POST["download"])) {
//     $pdf->Output('D', $fileName);
// }

?>