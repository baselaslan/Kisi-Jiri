# Kisi Jiri - save tree
*A little info about your project and/ or overview that explains what the project is about.*

kijk hier voor info over [treeAid](https://www.treeaid.org/about/our-approach/)

Tree Aid wants to address the issue of potential extinction of certain trees due to lack of awareness that farmers should not cut these trees down, especially before they have produced seeds. The NGO wants to increase farmers' knowledge through a radio program, by explaining the importance of regreening and preserving these trees. A voice-based application supporting local languages will be used to support this initiative. After hearing the message on the radio, farmers can call if they have an endangered tree on their land. TreeAid will aggregate the information gathered by the voice based application to be able to track the location of the endangered trees and collect seeds to mitigate the extinction. Farmers will also be able to request information about the description of trees or request seeds to plant on their land. The success of this initiative will  help to restore and protect biodiversity in Mali. The title that we have chosen for this project is “Kisi Jiri” which means save tree in Bambara, one of the languages spoken in Mali.

Basel Aslan, Maggie Mackenzie-Cardy, Seline Olijdam and Lieke Venneker

## Motivation
*A short description of the motivation behind the creation and maintenance of the project. This should explain why the project exists.*

## Code style
*If you're using any code style like xo, standard etc. That will help others while contributing to your project. Ex. -*

## Screenshots
*Include logo/demo screenshot etc.*

<img src="https://github.com/seline1511/Kisi-Jiri/blob/main/logo.png" alt="Kisi Jiri logo" width="300">

## Tech/framework used
Built with
- [Voxeo](https://evolution.voxeo.com/) 
- ADD DATABASE

## Code Example
*Show what the library does as concisely as possible, developers should be able to figure out how your project solves their problem by looking at the code example. Make sure the API you are showing off is obvious, and that your code is short and concise.*

Below an example of a menu that we use is shown. This menu has the id 'menu1EN', this name was chosen because it is the first of the main menus and it is the english menu. dtmf is set to true because voxeo should recognise the dual tone. Then we need a prompt for the output of this menu. In this case the output consists of multiple audio files. These files will be played in the respective order and based of the recognised tone, the next menu is chosen. This can be seen right below the closing tag of the prompt. The choice next is used to select a next menu to go to. So in this case, when the user choses 1, they go to reportEN. For 2 they go to infoEN and for 3 to requestEN, for every other number they hear an error message in english that they did not chose a valid number. After that the whole menu is played again until they choose a valid number. These menus are used for every part in the system where a choice needs to be made. When no choice is needed and only information is given to the user we used a form, which is also shown below. 

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

## Installation
*Provide step by step series of examples and explanations about how to get a development env running.*

## How to use?
*If people like your project they’ll want to learn how they can use it. To do so include step by step guide to use your project.*

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
