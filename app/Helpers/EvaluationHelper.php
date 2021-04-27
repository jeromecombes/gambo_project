<?php

namespace App\Helpers;

class EvaluationHelper
{

    public static function get_questions($form)
    {
        switch ($form) {
            case 'internship' :
                return array(
                    "Your name",
                    "Your University",
                    "Place of internship",
                    "1. Beginning date",
                    "1. End date",
                    "1. Hours per week",
                    "Monday From",
                    "Tuesday From",
                    "Wednesday From",
                    "Thursday From",
                    "Friday From",
                    "Saturday From",
                    "Sunday From",
                    "Monday To",
                    "Tuesday To",
                    "Wednesday To",
                    "Thursday To",
                    "Friday To",
                    "Saturday To",
                    "Sunday To",
                    "Special events",
                    "",
                    "If yes",
                    "2. Regular tasks",
                    "3a. % French",
                    "3b. % English",
                    "4. Interaction",
                    "5. Internship pertinent",
                    "6. Did you take any relevant courses",
                    "7. How your supervisor directed your work",
                    "8. Stage influence",
                    "9. What did you learn",
                    "10. Stage inflence future",
                    "10. Explain how",
                    "11. Did you receive any perks",
                    "Perks 1",
                    "Perks 2",
                    "Perks 3",
                    "Perks 4",
                    "12. Observations",
                    "I authorize program fo quote ...",
                );
                break;

            case 'linguistic' :
                return array(
                    "1a. Did you attend every session",
                    "1b. Why not",
                    "2a. Mastery of French language",
                    "2b. Understand French culture",
                    "3. Aspect of linguistique most helpful",
                    "4. Suggestions",
                    "5. Comments",
                    "Name",
                );
                break;

            case 'local' :
                return array (
                    "Course Name",
                    "Instructor",
                    "1. Efforts",
                    "2a. French level, begining",
                    "2b. French level, half-term",
                    "3. Did you attend every ...",
                    "Why not",
                    "4a. Assigned reading",
                    "Why not",
                    "4b. in class discussion",
                    "Why not",
                    "4c. Raise questions",
                    "Why not",
                    "5. Readings",
                    "5. Written work",
                    "5. Oral presnetation",
                    "5. Other (specify)",
                    "5. Other",
                    "6a. Visits or events outside",
                    "6b. Did you attend all of them",
                    "Why not",
                    "7a. Explain difficult material",
                    "7b. Organization",
                    "7c. Openness",
                    "7d. Fairness",
                    "7e. Comments and suggestions",
                    "7f.Encouragement",
                    "8. Assignments",
                    "9. Assignments effective",
                    "9. Comments",
                    "10. Observations and comments",
                    "Student name",
                );
                break;

            case 'method' :
                return array(
                    "1a. Did you attend every session",
                    "1b. Why not",
                    "2a. Mastery of French language",
                    "2b. Understand French culture",
                    "3. Aspect of method most helpful",
                    "4. Suggestions",
                    "5. Comments",
                    "Name",
                );
                break;

            case 'program' :
                return array (
                    "1. Main benefits",
                    "2. Is there anything you would have done differently",
                    "3. What did you learn about the French university",
                    "4. The most positive aspect taking a course in the French university",
                    "5. What percentage of the time did you speak French",
                    "6. The most significant improvement",
                    "Factors do you attribute the improvements",
                    "7a. Help for Practical matters",
                    "7b. Help for Extra-curricular activities",
                    "7c. Help for Social interactions",
                    "7d. Help for Academic issues",
                    "7e. Help for Housing matters",
                    "8a. Helpful for Practical matters",
                    "8b. Helpful for Extra-curricular activities",
                    "8c. Helpful for Social interactions",
                    "8d. Helpful for Academic issues",
                    "8e. Helpful for Housing matters",
                    "8. Comments",
                    "9a. Excursions outside of Paris",
                    "9a. Extracurricular Visits in Paris",
                    "9a. Cooking Classes / Cheese tasting",
                    "9a. Lunches at the Lycée Hôtelier",
                    "9a. Receptions",
                    "9a. Opera",
                    "9a. Theatre",
                    "9a. Dance / Ballet",
                    "9b. The most memorable / rewarding",
                    "10. Participation in any CIJP Excursions",
                    "10. Details",
                    "11. Did you try to meet French people",
                    "12. Did you join a specific club",
                    "12. Type",
                    "12. Name of organization 1",
                    "12. Address 1",
                    "12. tel/e-mail 1",
                    "12. Contact 1",
                    "12. Name of organization 2",
                    "12. Address 2",
                    "12. tel/e-mail 2",
                    "12. Contact 2",
                    "12. Name of organization 3",
                    "12. Address 3",
                    "12. tel/e-mail 3",
                    "12. Contact 3",
                    "12. Name of organization 4",
                    "12. Address 4",
                    "12. tel/e-mail 4",
                    "12. Contact 4",
                    "13. Did you undertake a \"stage\"",
                    "13. Stage evaluation",
                    "14. Features of the Bordeaux program the most useful",
                    "15. Housing and cultural activities in Bordeaux",
                    "16. Suggestions for the Bordeaux orientation session",
                    "17. Advice to students",
                    "18. Comments",
                    "Student name",
                );
                break;

            case 'tutoring' :
                return array(
                    "Instructor",
                    "1a. Did you attend every session",
                    "1b. Why not",
                    "2a. Mastery of French language",
                    "2b. Understand French culture",
                    "3. Aspect of tutorats most helpful",
                    "4. Suggestions",
                    "Name",
                );
                break;

            case 'univ' :
                return array(
                    "Name of couse",
                    "Course Code",
                    "Institution",
                    "Course Format",
                    "1. Efforts",
                    "2a. French level at the begining",
                    "2b. French level at half-term",
                    "3. Did you attend every class",
                    "4a. Keep up with assigned reading",
                    "4a. Why not",
                    "4b. Contribute to in-class discussion",
                    "4b. Why not",
                    "4c. Raise questions",
                    "4c. Why not",
                    "5. Understanding, Readings",
                    "5. Understanding, Written work",
                    "5. Understanding, Oral presentation",
                    "5. Understanding, Other (specify)",
                    "5. Understanding, Other",
                    "6a. Wherether were visits or events outside of class",
                    "6b. Did you attend all of them",
                    "6b. Why not",
                    "7a. Ability to explain difficult material",
                    "7b. Organization",
                    "7c. Openness",
                    "7d. Fairness",
                    "7e. Comments and suggestions",
                    "7f. Encouragement",
                    "8. Assignments",
                    "9. Where the assignments effective",
                    "9. Comments",
                    "10. Other comments",
                    "Student name",
                );
                break;
        }
    }
}
