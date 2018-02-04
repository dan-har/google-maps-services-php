<?php

namespace Niddit\Google\Maps\Service\Places;

final class Status
{
    /**
     * Indicates that no errors occurred; the place was successfully detected and at least one result was returned.
     */
    const OK = 'OK';

    /**
     * Indicates a server-side error; trying again may be successful.
     */
    const UNKNOWN_ERROR = 'UNKNOWN_ERROR';

    /**
     * Indicates that the referenced location (placeid) was valid but no longer refers to a valid result. This may
     * occur if the establishment is no longer in business.
     */
    const ZERO_RESULTS = 'ZERO_RESULTS';

    /**
     * Indicates that you are over your quota.
     */
    const OVER_QUERY_LIMIT = 'OVER_QUERY_LIMIT';

    /**
     * Indicates that your request was denied, generally because of lack of an invalid key parameter.
     */
    const REQUEST_DENIED = 'REQUEST_DENIED';

    /**
     * Generally indicates that the query (placeid) is missing.
     */
    const INVALID_REQUEST = 'INVALID_REQUEST';

    /**
     * Indicates that the referenced location (placeid) was not found in the Places database.
     */
    const NOT_FOUND = 'NOT_FOUND';
}
