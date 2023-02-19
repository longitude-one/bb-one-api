<?php

/**
 * This file is part of the BB-One Project
 *
 * PHP 8.2 | Symfony 6.2+
 *
 * Copyright LongitudeOne - Alexandre Tranchant
 * Copyright 2023 - 2023
 *
 */

namespace App\Status;

class CharacterStatus
{
    public const ACTION_ABORT = 'abort';
    public const ACTION_ACKNOWLEDGE = 'acknowledge';
    public const ACTION_ARCHIVE = 'archive';
    public const ACTION_ASSIGN = 'assign';
    public const ACTION_BAN = 'ban';
    public const ACTION_EDIT = 'edit';
    public const ACTION_PUBLISH = 'publish';
    public const ACTION_REJECT = 'reject';
    public const ACTION_SUBMIT = 'submit';
    public const ACTION_UNARCHIVE = 'unarchive';
    public const ACTION_UNBAN = 'unban';
    public const ACTION_VALIDATE = 'validate';

    public const STATUS_ABORTED = 'aborted';
    public const STATUS_ARCHIVED = 'archived';
    public const STATUS_ASSIGNED = 'assigned';
    public const STATUS_BANNED = 'banned';
    public const STATUS_DRAFT = 'draft';
    public const STATUS_PUBLISHED = 'published';
    public const STATUS_REJECTED = 'rejected';
    public const STATUS_SUBMITTED = 'submitted';
}
