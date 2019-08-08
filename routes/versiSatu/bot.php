<?php

return [
    /**
     * @SWG\Get(
     *   path="/v1/bot",
     *   summary="bot app",
     *   tags={"Bot"},
     *   @SWG\Response(
     *     response=200,
     *     description="Detail Information App",
     *     @SWG\Schema(ref="#/definitions/About")
     *   ),
     *  @SWG\Response(
     *        response=401,
     *        description="Unauthorized",
     *        @SWG\Schema(ref="#/definitions/Unauthorized")
     *     )
     * )
     */
    'GET bot' => 'bot/index',
    'OPTIONS bot' => 'bot/index',

];