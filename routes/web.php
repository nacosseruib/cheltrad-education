<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/',                                             'IndexController@createIndex')->name('index');
Route::get('about-us',                                      'AboutController@showAbout')->name('about');
Route::get('faq',                                           'AboutController@showFaq')->name('faq');
Route::get('contact-us',                                    'ContactController@index')->name('contact');
Route::post('contact-us',                                   'ContactController@store')->name('postContact');
//Products Paper
Route::get('free-sample-papers',                            'AllPaperController@createSamplePaper')->name('freeSamplePapers');
Route::get('/full-practice-papers',                          'AllPaperController@createFullPracticePapers')->name('fullPracticePapers');
Route::get('/mock-exams-paper',                              'AllPaperController@createMockExamsPaper')->name('mockExamsPaper');
Route::get('/past-papers-with-answers/{cartType?}/{category?}/{course?}', 'AllPaperController@listPapersWithAnswers')->name('listPaper');
//Products Quiz
Route::get('/quiz/online-testing',                           'AllQuizController@createOnlineTesting')->name('onlineTesting');
Route::get('/quiz/online-mock-exams',                        'AllQuizController@createOnlineMockExams')->name('onlineMockExams');
//Take Quiz
Route::get('/quiz/sample-quiz-details/{q?}/{ca?}/{co?}',     'AllQuizController@createAndPrepareSampleQuiz')->name('createSampleQuiz');
Route::get('/quiz/read-instruction/{q?}/{ca?}/{co?}',        'AllQuizController@createQuizIntruction')->name('quizInstruction');
Route::get('/quiz/in-progress/{q?}/{ca?}/{co?}',             'AllQuizController@startQuiz')->name('startQuiz');
Route::post('/quiz/n/in-progress',                           'AllQuizController@nextQuestionButton')->name('goToNextQuestion');
Route::get('/quiz/p/in-progress',                            'AllQuizController@previousQuestionButton')->name('goToPreviousQuestion');
Route::get('/quiz/s/in-progress/{q?}',                       'AllQuizController@skipQuestionButton')->name('goToSkipQuestion');
Route::get('/quiz/j/in-progress/{q?}/{k?}',                  'AllQuizController@jumpToNextQuestionButton')->name('jumpToNextQuestion');
Route::get('/quiz/result/{q?}',                              'AllQuizController@finishQuiz')->name('showQuizResult');
Route::get('/quiz-time',                                     'AllQuizController@getCurrentQuizTime');
Route::get('/update_quiz_time',                              'AllQuizController@updateCurrentQuizTimeGet');
Route::post('/update_quiz_time',                             'AllQuizController@updateCurrentQuizTime');
//Auth
Auth::routes();
Route::get('/logout', 								         'Auth\LoginController@logout')->name('logout');
//Cart
Route::get('/add-product', 								 'CartController@selectProduct')->name('pricing');
Route::post('/add-product', 								 'CartController@processProduct')->name('saveSelectedProduct');
Route::get('/view-cart', 								     'CartController@viewCart')->name('viewCart');
Route::get('/cart/remove/{id?}', 						     'CartController@removeCart')->name('removeCart');

//Stripe Payment
Route::get('/checkout/stripe',                              'StripePaymentController@createStripe')->name('checkOutStripe');
Route::post('/checkout/stripe',                             'StripePaymentController@postStripe')->name('postStripe');

