<?php

namespace Fresh\Medpravda\Repositories;

use Fresh\Medpravda\Medicine;
use Fresh\Medpravda\Question;
use Fresh\Medpravda\Umedicine;
use Fresh\Medpravda\Uquestion;
use DB;

class QuestionsRepository extends Repository
{
    protected $q_rep;
    protected $uq_rep;

    /**
     * QuestionsRepository constructor.
     * @param Question $question
     * @param Uquestion $uquestion
     */
    public function __construct(Question $question, Uquestion $uquestion)
    {
        $this->q_rep = $question;
        $this->uq_rep = $uquestion;
    }

    public function createQuestion($request, $source, $alias)
    {
        if ('ru' == $source) {
            $medicine = Medicine::where('alias', $alias)->first();
        } else {
            $medicine = Umedicine::where('alias', $alias)->first();
        }


        if (null == $medicine) {
            return ['error' => 'Ошибка получения данных'];
        }

        $count = count($request->get('question'));

        $q = [];
        for ($i = 0; $i < $count; $i++) {
            $q[] = ['question' => $request->get('question')[$i], 'answer' => $request->get('answer')[$i]];
        }

        DB::transaction(function () use ($q, $medicine) {
            $medicine->questions()->delete();
            $medicine->questions()->createMany($q);
        });

        return ['status' => 'Вопросы обновлены'];
    }

}