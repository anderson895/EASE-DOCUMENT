<div id="printableArea" class="max-w-4xl mx-auto bg-white p-8 mt-12 shadow-lg rounded-lg">
    <div class="text-center">
      <h1 class="text-xl font-bold uppercase">Republic of the Philippines</h1>
      <h2 class="text-lg font-semibold">Province of Albay</h2>
      <h3 class="text-lg font-semibold">Municipality of Sto. Domingo</h3>
      <h4 class="text-2xl font-extrabold mt-4">Barangay San Vicente</h4>
    </div>
    
    <div class="mt-8">
      <h1 class="text-xl font-bold text-center uppercase underline">Barangay Clearance</h1>
    </div>

    <div class="mt-12"> <!-- Increased margin-top here -->
      <p class="text-justify">
        <span class="font-bold">TO WHOM IT MAY CONCERN:</span>
      </p>
      <p class="mt-4 text-justify">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        This is to certify that <span class="underline">______________<?=$fullName?>_________________</span>, 
        <span class="underline">____<?=$age?>____</span> years old, and a resident of Barangay San Vicente, 
        Sto. Domingo, Albay, is known to be of good moral character and a law-abiding citizen in the community.
      </p>
      <p class="mt-4 text-justify">
        To certify further, that he/she has no derogatory and/or criminal records filed in this barangay.
      </p>
    </div>

    <div class="mt-8">
      <p class="text-justify">
        <span class="font-bold">Issued</span> this 
        <span class="underline">____<?=$ordinalDay?>____</span> day of 
        <span class="underline">__________<?=$month?>______________</span>, 
        <?=$year?> at Barangay San Vicente, Sto. Domingo, Albay, upon request of the interested party for whatever legal purposes it may serve.
      </p>
    </div>

    <div class="mt-12 text-right">
      <p class="font-bold">JOEL B. LLORCA</p>
      <p class="text-sm">Barangay Captain</p>
    </div>

    <div class="mt-8 border-t pt-4">
      <p>O.R. Code: <span class="underline">____<?=$cr_code?></span></p>
      <p>Date Issued: <span class="underline">_________<?=$formattedDate?>____________</span></p>
      <p>Doc. Stamp: <span class="underline">Paid</span></p>
    </div>
</div>