# Kisi Jiri - save tree

[Tree Aid](https://www.treeaid.org/about/our-approach/) is a non-governmental organization (NGO) that reduces poverty and protects the environment in Africa, while working together with local communities. In Mali, Tree Aid wants to address the issue of the potential extinction of five types of trees due to a lack of awareness that people should not cut these trees down, especially before they have produced seeds. The NGO wants to increase locals’ knowledge through a radio program, by explaining the importance of regreening and preserving these trees. A voice-based application, Kisi Jiri, which supports local languages will be used to make this initiative possible. A voice application has the benefit that illiterate people can also use the application, and telephony is already a widely adopted technology in Mali. After hearing the message from Tree Aid on the radio, people can call if they have an endangered tree on their land. Tree Aid will aggregate the information gathered by the voice-based application to be able to track the location of the callers,  for example to be able to collect the seeds from the endangered trees to mitigate the extinction. Callers will also be able to request information about the description of trees or request seeds to plant on their land. This initiative can help to restore and protect biodiversity in Mali. The title that we have chosen for this project is “Kisi Jiri” which means “save tree” in Bambara, one of the most spoken languages in Mali.

**The creators of this project are:** Basel Aslan, Maggie Mackenzie-Cardy, Seline Olijdam and Lieke Venneker

## Project logo
<img src="https://github.com/seline1511/Kisi-Jiri/blob/main/logo.png" alt="Kisi Jiri logo" width="300">

## Technology used
Built with
- [Voxeo](https://evolution.voxeo.com/) - used for hosting the voice XML code that runs the appliciation.
- [Heroku](https://heroku.com)  - database that stores all the necessary information that is given by the users. 

## Framework
The complete process of the voice application can be seen in the flowchart below. 
<img src="https://github.com/seline1511/Kisi-Jiri/blob/main/flowchart of the system.jpeg" alt="Kisi Jiri logo" width="900">


## Code Example
*Show what the library does as concisely as possible, developers should be able to figure out how your project solves their problem by looking at the code example. Make sure the API you are showing off is obvious, and that your code is short and concise.*

Below an example of a menu that we use is shown. This menu has the id 'menu1EN', this name was chosen because it is the first of the main menus and it is the english menu. Dtmf is set to true because voxeo should recognise the dual tone. Then we need a prompt for the output of this menu. In this case the output consists of multiple audio files. These files will be played in the respective order and based of the recognised tone, the next menu is chosen. This can be seen right below the closing tag of the prompt. The choice next is used to select a next menu to go to. So in this case, when the user choses 1, they go to reportEN. For 2 they go to infoEN and for 3 to requestEN, for every other number they hear an error message in english that they did not chose a valid number. After that the whole menu is played again until they choose a valid number. These menus are used for every part in the system where a choice needs to be made. When no choice is needed and only information is given to the user we used a form, which is also shown below. 

```XML
<menu id="menu1EN" dtmf="true">
<!--  In this menu the caller can choose what they want to do: report a tree, get information, or request seeds.  -->
  <prompt>
    <audio src="http://ict4d2021.saadittoh.com/group11/wavs/EN_select_what_you_want_to_do.wav"/>
    <audio src="http://ict4d2021.saadittoh.com/group11/wavs/EN_choose_1_to_report_tree.wav"/>
    <audio src="http://ict4d2021.saadittoh.com/group11/wavs/EN_choose_2_to_get_info_about_tree.wav"/>
    <audio src="http://ict4d2021.saadittoh.com/group11/wavs/EN_choose_3_to_request_seeds.wav"/>
  </prompt>
  <choice next="#reportEN"/>
  <choice next="#infoEN"/>
  <choice next="#requestEN"/>
</menu>
```

In this form we repeat the information that the user gave us. Which in this case is that they selected that the tree has seeds. For forms we do not use *choice next* but *goto next*.

```XML
<form id="seedsNL">
  <block>
  <prompt>
    <audio src="http://ict4d2021.saadittoh.com/group11/wavs/NL_you_have_selected_that_your_tree_has_seeds.wav"/>
  </prompt>
  <goto next="#menu2NL"/>
  </block>
</form>
```

## Installation & How to use
Create an account at [Voxeo](https://evolution.voxeo.com/). Go to Files, Logs, & Reports. Then you can go to the www folder and at the bottom of that page there is an option to add a new file. Create a new file and go to the application manager and choose add application. Here you write down the name of the application and select voice phone calls. Then a new menu opens below named, voice application type. Here you have to seelect the following things: Development, Europe, VoiceXML, Nuance, EU-Prophecy VoiceXML. The next menu is voice URL, here you can click on file manager and select the file that you just created. Now click "Create Application" and your application is created. Then a new tab opens named, contact methods. There you can click on international number. This redirects you to a page that shows phone numbers per country and their pin. This is the number you need to call and the pin you need to use when the application asks for it. After the pincode your application should start. It should do nothing right now, becasue your file is still empty. You can use our code as an example and call again.



## Code structure

### Here we will give a short overview of all the menus and forms that we use together with a short explanation of what it does.

**Language**: Here the caller can select the language

**Menu1** : In this menu, the caller can choose what they want to do: report a tree, get information, or request seeds.

---------------------------------------------------------------------------------------
#### The first option is to report a tree

**Report tree** : Start of reporting a tree. This is where the farmers can choose which tree they have

**Seeds or no seeds** : The next 5 menus are for the 5 different trees, this is where we ask whether the selected tree has seeds or not.

**Seeds** : Here the answer about seeds or no seeds is repeated

**noseeds** :  Here the answer about seeds or no seeds is repeated

**Menu2** : Here we ask if there is another tree to report, if so the process starts from the
question of what tree the caller would like to report. If not we continue with the next part

--------------------------------------------------------------------------------------------
#### The second option is to get information about the trees

**Info about trees** :  Through this menu, the caller can request seeds of any type of tree.


--------------------------------------------------------------------------------------------
#### The last option is to request seeds of the trees yourself

**Request seeds**  : Through this menu, the caller can request seeds of any type of tree

--------------------------------------------------------------------------------------------
#### These last menus are both used for reporting and requesting. For getting information only the last menu is used.

**Farmer name** :  We now ask for the farmers' information, to ensure that the people of TreeAid
know where to find the farmer.

**Goodbye** :  Thank you for calling Kisi Jiri. Have a nice day!

## Information Storage

### Here we will give an overview of the database structure and what values are stored

For our project we are using a MySQL database hosted by Heroku. In the file database.php you can find the credentials for this database and example code on how to connect and view the rows in the database, as well as how we collect the values from our VoiceXML application and store them.

Below we give details of the information stored in the database which is collected during the call

| Name       | Type         | Extra information           | Description                                                                                                      |
|------------|--------------|-----------------------------|------------------------------------------------------------------------------------------------------------------|
| ID         | INT          | AUTO_INCREMENT, PRIMARY KEY | Automatically generated key                                                                                      |
| user       | BIGINT(255)  | NOT NULL                    | Phone number of the caller                                                                                       |
| tree       | VARCHAR(255) | NOT NULL                    | Selected tree                                                                                                    |
| seeds      | VARCHAR(255) | NOT NULL                    | Whether the tree has seeds or not                                                                                |
| name       | VARCHAR(255) | NOT NULL                    | Name of audio file that has the recording of the caller's name. This is in the format $user$time_name.wav       |
| village    | VARCHAR(255) | NOT NULL                    | Name of audio file that has the recording of the caller's village. This is in the format $user$time_village.wav |
| created_at | TIMESTAMP    | DEFAULT CURRENT_TIMESTAMP   | Date of entry creation                                                                             


For the audio files, we save the files themselves onto the server hosting the database.php code and we enter just the name of those files in the database. Volunteers will later manually go through these entries and can replace name and village with the transcribed audio file.
