<?php

namespace Anand\Base;

use \Exception;
use \PDO;
use Anand\Make as ChildMake;
use Anand\MakeQuery as ChildMakeQuery;
use Anand\Map\MakeTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'make' table.
 *
 *
 *
 * @method     ChildMakeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildMakeQuery orderByBrandname($order = Criteria::ASC) Order by the BrandName column
 *
 * @method     ChildMakeQuery groupById() Group by the id column
 * @method     ChildMakeQuery groupByBrandname() Group by the BrandName column
 *
 * @method     ChildMakeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildMakeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildMakeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildMakeQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildMakeQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildMakeQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildMakeQuery leftJoinVehicle($relationAlias = null) Adds a LEFT JOIN clause to the query using the Vehicle relation
 * @method     ChildMakeQuery rightJoinVehicle($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Vehicle relation
 * @method     ChildMakeQuery innerJoinVehicle($relationAlias = null) Adds a INNER JOIN clause to the query using the Vehicle relation
 *
 * @method     ChildMakeQuery joinWithVehicle($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Vehicle relation
 *
 * @method     ChildMakeQuery leftJoinWithVehicle() Adds a LEFT JOIN clause and with to the query using the Vehicle relation
 * @method     ChildMakeQuery rightJoinWithVehicle() Adds a RIGHT JOIN clause and with to the query using the Vehicle relation
 * @method     ChildMakeQuery innerJoinWithVehicle() Adds a INNER JOIN clause and with to the query using the Vehicle relation
 *
 * @method     \Anand\VehicleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildMake findOne(ConnectionInterface $con = null) Return the first ChildMake matching the query
 * @method     ChildMake findOneOrCreate(ConnectionInterface $con = null) Return the first ChildMake matching the query, or a new ChildMake object populated from the query conditions when no match is found
 *
 * @method     ChildMake findOneById(int $id) Return the first ChildMake filtered by the id column
 * @method     ChildMake findOneByBrandname(string $BrandName) Return the first ChildMake filtered by the BrandName column *

 * @method     ChildMake requirePk($key, ConnectionInterface $con = null) Return the ChildMake by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMake requireOne(ConnectionInterface $con = null) Return the first ChildMake matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMake requireOneById(int $id) Return the first ChildMake filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildMake requireOneByBrandname(string $BrandName) Return the first ChildMake filtered by the BrandName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildMake[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildMake objects based on current ModelCriteria
 * @method     ChildMake[]|ObjectCollection findById(int $id) Return ChildMake objects filtered by the id column
 * @method     ChildMake[]|ObjectCollection findByBrandname(string $BrandName) Return ChildMake objects filtered by the BrandName column
 * @method     ChildMake[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class MakeQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Anand\Base\MakeQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Anand\\Make', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildMakeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildMakeQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildMakeQuery) {
            return $criteria;
        }
        $query = new ChildMakeQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildMake|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = MakeTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(MakeTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildMake A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, BrandName FROM make WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildMake $obj */
            $obj = new ChildMake();
            $obj->hydrate($row);
            MakeTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildMake|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildMakeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(MakeTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildMakeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(MakeTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMakeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(MakeTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(MakeTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(MakeTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the BrandName column
     *
     * Example usage:
     * <code>
     * $query->filterByBrandname('fooValue');   // WHERE BrandName = 'fooValue'
     * $query->filterByBrandname('%fooValue%'); // WHERE BrandName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $brandname The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildMakeQuery The current query, for fluid interface
     */
    public function filterByBrandname($brandname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($brandname)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $brandname)) {
                $brandname = str_replace('*', '%', $brandname);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(MakeTableMap::COL_BRANDNAME, $brandname, $comparison);
    }

    /**
     * Filter the query by a related \Anand\Vehicle object
     *
     * @param \Anand\Vehicle|ObjectCollection $vehicle the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildMakeQuery The current query, for fluid interface
     */
    public function filterByVehicle($vehicle, $comparison = null)
    {
        if ($vehicle instanceof \Anand\Vehicle) {
            return $this
                ->addUsingAlias(MakeTableMap::COL_ID, $vehicle->getMakeId(), $comparison);
        } elseif ($vehicle instanceof ObjectCollection) {
            return $this
                ->useVehicleQuery()
                ->filterByPrimaryKeys($vehicle->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByVehicle() only accepts arguments of type \Anand\Vehicle or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Vehicle relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildMakeQuery The current query, for fluid interface
     */
    public function joinVehicle($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Vehicle');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Vehicle');
        }

        return $this;
    }

    /**
     * Use the Vehicle relation Vehicle object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \Anand\VehicleQuery A secondary query class using the current class as primary query
     */
    public function useVehicleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinVehicle($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Vehicle', '\Anand\VehicleQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildMake $make Object to remove from the list of results
     *
     * @return $this|ChildMakeQuery The current query, for fluid interface
     */
    public function prune($make = null)
    {
        if ($make) {
            $this->addUsingAlias(MakeTableMap::COL_ID, $make->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the make table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MakeTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            MakeTableMap::clearInstancePool();
            MakeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(MakeTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(MakeTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            MakeTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            MakeTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // MakeQuery
