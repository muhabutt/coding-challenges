<?php

$string = "
Nursing student Eilidh Duncan should be focusing on her final coursework and forthcoming exams but like thousands of other across the UK she has been fast-tracked to the frontline as part of the NHS response to Covid-19.

The emergency means the 22-year-old will start work before she graduates from Glasgow Caledonian University.

The third-year student described the last few weeks as a \"blur\". \"I'm nervous but kind of excited as well,\" she says.

Eilidh, from Lochgilphead, Argyll and Bute, was already on her penultimate placement but has agreed to remain at Glasgow Royal Infirmary for the next five months.

And such is the extreme nature of the situation she will become an NHS employee this week -before she qualifies.

Image copyrightGETTY IMAGES
Eilidh said: \"It is good to be chucked in the deep end because they just let you get on with it more.

\"I was going to be doing it in six months anyway so getting paid for it earlier than we are meant to be is always a bonus as well.\"

She will now be able to quit her part-time job but the rapid promotion is not without its challenges.

\"Working in a pandemic and also still having to do essays and online exams is stressful,\" she says.

\"We don't have a graduation any more. It is quite hard to sit down and do essays knowing I am not going to graduate and I'm not going to go to a grad ball. That's the fun part of it and that's what you look forward to.\"

The university has since confirmed students will be able to graduate in absentia this summer but will have the option of participating in a future ceremony.

'Highly relevant'
The decision to use student nurses was taken by the UK government as part of a strategy which also targeted retired healthcare staff.

Eileen McKenna, associate director of professional practice at the Royal College of Nursing in Scotland, said students can continue with their academic studies or to go into their clinical placements.

She says: \"We have been quite clear that there must be a choice for the students taking into account their individual circumstances.\"

Ms McKenna said it is up to individual universities how they proceed with final assessments and exams.

Eilidh is one of more than 500 student nurses from Glasgow Caledonian University who start work with the NHS this week.

'Amazing response'
Prof Jacqueline McCallum, head of the department of nursing and community health, said: \"The students are well prepared, having developed their skills and knowledge by assessing and caring for a wide range of patients, including those whose conditions have been deteriorating.

\"The clinical skills that the students have been developing are highly relevant to the current Covid-19 pandemic.\"

The students recently moved to online learning and have been able to continue their studies with a range of online scenarios.

Prof McCallum said: \"Although they are working for the NHS, they remain our students and we are thinking of them.

\"Their personal tutors are still there to support them if they are struggling or need help.\"

During the first minister's daily briefing chief nursing officer Fiona McQueen hailed the amazing response from students.

She said more than 2,000 have been deployed this week, with more to come.

Ms McQueen added: \"It is a real thrill for me to see their compassion and professionalism\".
";


//explode the string by space
$arrayOfWords = explode(' ', $string);

//marge the value according to their occurrence and return new array
$counted = array_count_values($arrayOfWords);

// search array by heightes value and return key
echo "<h1>Most Common word in the provided string is => " . array_search(max($counted), $counted) ."</h1>";
echo <<<EOL
<pre 
style='font-size: 20px;
    padding: 10px;
    border: 1px solid;
    width: 90%;
    white-space: pre-line;'>
$string
</pre>
EOL;
